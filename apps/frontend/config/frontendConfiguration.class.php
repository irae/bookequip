<?php

class frontendConfiguration extends sfApplicationConfiguration
{
   public function configure()
    {
        $this->dispatcher->connect('form.post_configure', array($this, 'listenToFormPostConfigure'));
    }

    /**
     * Listens to the view.configure_format event.
     *
     * @param sfEvent An sfEvent instance
     * @static
     */
    static function listenToFormPostConfigure(sfEvent $event)
    {
        $form = $event->getSubject();
		if (!in_array($form->getName(), array('signin'))) {
	        $widgetSchema = $form->getWidgetSchema();
	        foreach ($form->getValidatorSchema()->getFields() as $fieldName => $validator)
	        {
	            if (isset($widgetSchema[$fieldName]))
	            {
	                $label = $widgetSchema[$fieldName]->getLabel() ? $widgetSchema[$fieldName]->getLabel() : sfInflector::humanize($fieldName);
	                $asterisk = $validator->getOption('required') ? '<span>&nbsp;*</span>' : null;
	                $widgetSchema[$fieldName]->setLabel($label . $asterisk);
	            }

	        }
		}
    }
}
