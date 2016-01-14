<?php
namespace AppBundle\Form;

use AppBundle\Entity\PhpOptions;
use AuronConsultingOSS\Docker\PhpExtension\AvailableExtensions;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Form for PHP options.
 *
 * @package   AppBundle\Form
 * @copyright Auron Consulting Ltd
 */
class PhpType extends AbstractType
{
    /**
     * Builds the form definition.
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isSymfonyApp', CheckboxType::class, ['required' => false, 'label' => 'Is yours a Symfony app? Check this to configure nginx accordingly'])
            ->add('phpExtensions', ChoiceType::class, [
                'choices'  => $this->getChoices(),
                'multiple' => true,
                'label'    => 'Available PHP extensions',
                'required' => false,
            ]);
    }

    /**
     * Returns all available extensions as an array we can feed to ChoiceType.
     *
     * @return array
     */
    private function getChoices()
    {
        $choices = [];
        foreach (AvailableExtensions::OPTIONAL_EXTENSIONS_MAP as $name => $extension) {
            $choices[$name] = $name;
        }

        return $choices;
    }

    /**
     * This should return a string with the FQDN of the entity class associated to this form.
     *
     * @return string
     */
    protected function getDataClass()
    {
        return PhpOptions::class;
    }
}
