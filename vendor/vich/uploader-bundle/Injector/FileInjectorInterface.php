<?php

namespace Vich\UploaderBundle\Injector;

use Vich\UploaderBundle\Mapping\PropertyMapping;

/**
 * FileInjectorInterface.
 *
 * @author Dustin Dobervich <ddobervich@gmail.com>
 */
interface FileInjectorInterface
{
    /**
     * Injects the uploadable field of the specified object and mapping.
     *
     * The field is populated with a \Symfony\Component\HttpFoundation\File\File
     * instance.
     *
<<<<<<< HEAD
     * @param object          $obj     The object
     * @param PropertyMapping $mapping The mapping representing the field to populate
=======
     * @param object          $obj     The object.
     * @param PropertyMapping $mapping The mapping representing the field to populate.
>>>>>>> anis
     */
    public function injectFile($obj, PropertyMapping $mapping);
}
