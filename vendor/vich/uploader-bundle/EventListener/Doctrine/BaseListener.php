<?php

namespace Vich\UploaderBundle\EventListener\Doctrine;

use Doctrine\Common\EventSubscriber;
<<<<<<< HEAD
=======

>>>>>>> anis
use Vich\UploaderBundle\Adapter\AdapterInterface;
use Vich\UploaderBundle\Handler\UploadHandler;
use Vich\UploaderBundle\Metadata\MetadataReader;
use Vich\UploaderBundle\Util\ClassUtils;

/**
<<<<<<< HEAD
 * BaseListener.
=======
 * BaseListener
>>>>>>> anis
 *
 * @author Kévin Gomez <contact@kevingomez.fr>
 */
abstract class BaseListener implements EventSubscriber
{
    /**
     * @var string
     */
    protected $mapping;

    /**
<<<<<<< HEAD
     * @var AdapterInterface
=======
     * @var AdapterInterface $adapter
>>>>>>> anis
     */
    protected $adapter;

    /**
<<<<<<< HEAD
     * @var MetadataReader
=======
     * @var MetadataReader $metadata
>>>>>>> anis
     */
    protected $metadata;

    /**
<<<<<<< HEAD
     * @var UploadHandler
=======
     * @var UploadHandler $handler
>>>>>>> anis
     */
    protected $handler;

    /**
     * Constructs a new instance of UploaderListener.
     *
<<<<<<< HEAD
     * @param string           $mapping  The mapping name
     * @param AdapterInterface $adapter  The adapter
     * @param MetadataReader   $metadata The metadata reader
     * @param UploadHandler    $handler  The upload handler
=======
     * @param string           $mapping  The mapping name.
     * @param AdapterInterface $adapter  The adapter.
     * @param MetadataReader   $metadata The metadata reader.
     * @param UploadHandler    $handler  The upload handler.
>>>>>>> anis
     */
    public function __construct($mapping, AdapterInterface $adapter, MetadataReader $metadata, UploadHandler $handler)
    {
        $this->mapping = $mapping;
        $this->adapter = $adapter;
        $this->metadata = $metadata;
        $this->handler = $handler;
    }

    /**
     * Checks if the given object is uploadable using the current mapping.
     *
<<<<<<< HEAD
     * @param mixed $object The object to test
=======
     * @param mixed $object The object to test.
>>>>>>> anis
     *
     * @return bool
     */
    protected function isUploadable($object)
    {
        return $this->metadata->isUploadable(ClassUtils::getClass($object), $this->mapping);
    }

    /**
     * Returns a list of uploadable fields for the given object and mapping.
     *
<<<<<<< HEAD
     * @param mixed $object The object to use
     *
     * @return string[] A list of field names
=======
     * @param mixed $object The object to use.
     *
     * @return array<string> A list of field names.
>>>>>>> anis
     */
    protected function getUploadableFields($object)
    {
        $fields = $this->metadata->getUploadableFields(ClassUtils::getClass($object), $this->mapping);

<<<<<<< HEAD
        return array_map(function ($data) {
=======
        return array_map(function($data) {
>>>>>>> anis
            return $data['propertyName'];
        }, $fields);
    }
}
