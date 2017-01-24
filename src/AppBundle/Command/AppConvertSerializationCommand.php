<?php

namespace AppBundle\Command;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\Serializer\Annotation\Groups as GroupsAnnotation;

/**
 * Class AppConvertSerializationCommand
 * @package AppBundle\Command
 */
class AppConvertSerializationCommand extends ContainerAwareCommand
{
    use ContainerAwareTrait;

    /**
     * @var AnnotationReader
     */
    private $annotationReader;

    /**
     * @var EntityManager
     */
    private $entityManager;

    protected function configure()
    {
        $this
            ->setName('app:convert-serialization')
            ->setDescription('...')
            ->addArgument('argument', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $container = $this->getContainer();
        $this->annotationReader = $container->get('annotation_reader');
        $this->entityManager = $container->get('doctrine.orm.entity_manager');
        $metaData = $this->entityManager
            ->getMetadataFactory()
            ->getAllMetadata();

        $annotations = [];
        foreach($metaData as $meta) {
            foreach($meta->getAssociationNames() as $fieldName)
                $this->getAnnotations($meta, $fieldName, $annotations);

            foreach($meta->getFieldNames() as $fieldName)
                $this->getAnnotations($meta, $fieldName, $annotations);
        }

        $this->printYaml($annotations);
    }

    private function getAnnotations(ClassMetadata $meta,
                                    string $fieldName,
                                    &$annotations) {
        $name = $meta->getName();
        $isAppEntity = preg_match('/^AppBundle/', $name);
        $inherited = $meta->isInheritedField($fieldName) ||
            $meta->isInheritedAssociation($fieldName);

        if (!$inherited && $isAppEntity) {
            if (!isset($annotations[$name]))
                $annotations[$name] = [];
            $prop =  new \ReflectionProperty($name, $fieldName);
            $groupsAnnotation = $this->annotationReader
                ->getPropertyAnnotation($prop, GroupsAnnotation::class);
            if ($groupsAnnotation)
                $annotations[$name][$fieldName] = $groupsAnnotation->getGroups();
        }
    }

    private function printYaml($annotations) {
        $tab = '    ';
        foreach ($annotations as $class => $annotation) {
            if (!empty($annotation)) {
                echo "$class:\n";
                echo "{$tab}attributes:\n";

                foreach ($annotation as $key => $field){
                    $groups = join(', ', array_map(function($str) {
                        return "'$str'";
                    }, $field));
                    echo "{$tab}{$tab}" . $key . ": { groups: [$groups] }\n";
                }

                echo "\n";
            }
        }
    }

}
