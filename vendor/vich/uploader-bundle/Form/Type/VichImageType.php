<?php

namespace Vich\UploaderBundle\Form\Type;

<<<<<<< HEAD
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use Vich\UploaderBundle\Handler\UploadHandler;
use Vich\UploaderBundle\Mapping\PropertyMappingFactory;
use Vich\UploaderBundle\Storage\StorageInterface;

/**
 * @author Kévin Gomez <contact@kevingomez.fr>
 * @author Konstantin Myakshin <koc-dp@yandex.ru>
 * @author Massimiliano Arione <max.arione@gmail.com>
 */
class VichImageType extends VichFileType
{
    /**
     * @var CacheManager
     */
    private $cacheManager;

    public function __construct(StorageInterface $storage, UploadHandler $handler, PropertyMappingFactory $factory, PropertyAccessorInterface $propertyAccessor = null, CacheManager $cacheManager = null)
    {
        parent::__construct($storage, $handler, $factory, $propertyAccessor);
        $this->cacheManager = $cacheManager;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'image_uri' => true,
            'imagine_pattern' => null,
        ]);

        $resolver->setAllowedTypes('image_uri', ['bool', 'string', 'callable']);

        $imageUriNormalizer = function (Options $options, $imageUri) {
            return null !== $imageUri ? $imageUri : $options['download_uri'];
        };

        $resolver->setNormalizer('image_uri', $imageUriNormalizer);
    }

    /**
=======
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

class VichImageType extends VichFileType
{
    /**
>>>>>>> anis
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
<<<<<<< HEAD
        $object = $form->getParent()->getData();
        $view->vars['object'] = $object;
        $view->vars['image_uri'] = null;
        $view->vars['download_uri'] = null;

        if ($object) {
            if ($options['imagine_pattern']) {
                if (!$this->cacheManager) {
                    throw new \RuntimeException('LiipImagineBundle must be installed and configured for using "imagine_pattern" option.');
                }

                $uri = $this->storage->resolveUri($object, $form->getName());
                if ($uri) {
                    $view->vars['image_uri'] = $this->cacheManager->getBrowserPath($uri, $options['imagine_pattern']);
                }
            } else {
                $view->vars['image_uri'] = $this->resolveUriOption($options['image_uri'], $object, $form);
            }

            $view->vars = array_replace(
                $view->vars,
                $this->resolveDownloadLabel($options['download_label'], $object, $form)
            );

            $view->vars['download_uri'] = $this->resolveUriOption($options['download_uri'], $object, $form);
        }
        // required for BC
        //TODO: remove for 2.0
        $view->vars['show_download_link'] = !empty($view->vars['download_uri']);
=======
        $view->vars['object'] = $form->getParent()->getData();
        $view->vars['show_download_link'] = $options['download_link'];

        if ($view->vars['object']) {
            $view->vars['download_uri'] = $this->storage->resolveUri($form->getParent()->getData(), $form->getName());
        }
>>>>>>> anis
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'vich_image';
    }
<<<<<<< HEAD
=======

    // BC for SF < 2.8
    public function getName()
    {
        return $this->getBlockPrefix();
    }
>>>>>>> anis
}
