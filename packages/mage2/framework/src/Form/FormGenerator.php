<?php

namespace Mage2\Framework\Form;

use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Session\Session;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class FormGenerator
{

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * The URL generator instance.
     *
     * @var \Illuminate\Contracts\Routing\UrlGenerator
     */
    protected $url;
    /**
     * The URL generator instance.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * The View factory instance.
     *
     * @var \Illuminate\Contracts\View\Factory
     */
    protected $view;

    /**
     * The CSRF token used by the form builder.
     *
     * @var string
     */
    protected $csrfToken;

    /**
     * The session store implementation.
     *
     * @var \Illuminate\Session\SessionInterface
     */
    protected $session;

    /**
     * The current model instance for the form.
     *
     * @var mixed
     */
    protected $model;

    /**
     * Create a new form generator instance.
     *
     * @param  \Illuminate\Filesystem\ $fileSystem
     * @param  \Illuminate\Contracts\Routing\UrlGenerator $url
     * @param  \Illuminate\Http\Request $request
     * @param  \Illuminate\Contracts\View\Factory $view
     * @param  string $csrfToken
     */
    public function __construct(Filesystem $fileSystem, UrlGenerator $url, Request $request, Factory $view, $csrfToken)
    {
        $this->files = $fileSystem;
        $this->url = $url;
        $this->request = $request;
        $this->view = $view;
        $this->csrfToken = $csrfToken;
    }

    /**
     * bind the form with model
     *
     * @todo add attribute feature and etc
     *
     * @param  Object $model
     * @param  Array $dummyReplacement
     * @return $stub
     */
    public function bind($model, $dummyReplacement = [])
    {
        $this->model = $model;
        $stub = $this->open($dummyReplacement);


        return $stub;
    }

    /**
     * get the form open stub template
     *
     * @todo add attribute feature and etc
     *
     * @param  Array $attributes
     * @return $stub
     */
    public function open($attributes = [])
    {
        $attributes = Collection::make($attributes);
        $stub = $this->files->get($this->getStub('form-open'));
        $formOpenAttribute = NULL;

        if ($attributes->has('files')) {
            //$formOpenAttribute ['enctype'] = 'multipart/form-data';
            $attributes->pull('files');
            $attributes->put('enctype', 'multipart/form-data');
            //$this->replaceStubText($stub, strtoupper("DUMMYATTRIBUTE"), "=''");
        }

        foreach ($attributes as $dummyText => $replacement) {

            if (strtolower($dummyText) == "method") {

                if (strtolower($replacement) == "put" || strtolower($replacement) == "delete") {

                    $attributes->put('method', 'post');
                    $this->replaceStubText($stub, strtoupper("DUMMY" . $dummyText), "POST");
                    $dummyHiddenStub = $this->files->get($this->getStub('_method'));
                    $this->replaceStubText($dummyHiddenStub, strtoupper("DUMMYMETHOD"), strtoupper($replacement));
                    $stub .= $dummyHiddenStub;
                }
            }
        }

        //if (NULL !== $formOpenAttribute) {
        $attributeText = $this->getAttributeText($attributes);
        $this->replaceStubText($stub, strtoupper("DUMMYATTRIBUTE"), $attributeText);
        //}
        $csrfStub = $this->files->get($this->getStub('_csrf'));
        $this->replaceStubText($csrfStub, "DUMMYCSRF", $this->csrfToken);


        $stub = $stub . $csrfStub;


        return $stub;
    }

    /**
     * get the form closestub template
     * @return $stub
     */
    public function close()
    {
        $stub = $this->files->get($this->getStub('form-close'));
        return $stub;
    }

    /**
     * get the text field using stub template
     *
     * @todo add attribute feature and etc
     *
     * @param  string $fieldName
     * @param  string $label
     * @param  array $attributes
     * @return $stub
     */
    public function textarea($fieldName, $label = "", $attributes = ['class' => 'form-control'])
    {

        $attributes = Collection::make($attributes);
        $stub = $this->files->get($this->getStub('textarea'));

        $attributes->put('name', $fieldName);
        $attributes->put('id', $fieldName);

        $this->replaceStubText($stub, "DUMMYFIELDNAME", $fieldName);
        $this->replaceStubText($stub, "DUMMYLABEL", $label);

        $this->setAttributeTextOfStub($stub, $attributes);
        $this->setErrorStubAndValue($stub, $fieldName);

        return $stub;
    }

    /**
     * get the text field using stub template
     *
     * @todo add attribute feature and etc
     *
     * @param  string $fieldName
     * @param  string $label
     * @param  array $attributes
     * @return $stub
     */
    public function select($fieldName, $label = "", $options = [], $attributes = ['class' => 'form-control'])
    {

        $stub = $this->files->get($this->getStub('select'));

        $this->replaceStubText($stub, "DUMMYFIELDNAME", $fieldName);
        $this->replaceStubText($stub, "DUMMYLABEL", $label);

        $value = null;
        $updateValue = true;
        if (isset($attributes['value'])) {
            $value = $attributes['value'];
            unset($attributes['value']);
            $updateValue = false;

        }
        $this->setAttributeTextOfStub($stub, $attributes);

        $this->setOptionTextOfStub($stub, $options, $fieldName, $value);
        $this->setErrorStubAndValue($stub, $fieldName, $updateValue);

        return $stub;
    }

    /**
     * get the text field using stub template
     *
     * @todo add attribute feature and etc
     *
     * @param  string $fieldName
     * @param  string $label
     * @param  array $attributes
     * @return $stub
     */
    public function hidden($fieldName, $value = "")
    {

        $stub = $this->files->get($this->getStub('hidden'));

        $this->replaceStubText($stub, "DUMMYFIELDNAME", $fieldName);
        $this->replaceStubText($stub, "DUMMYVALUE", $value);

        return $stub;
    }


    /**
     * get the text field using stub template
     *
     * @param  string $fieldName
     * @param  string $label
     * @param  array $attributes
     * @return $stub
     */
    public function text($fieldName, $label = "", $attributes = ['class' => 'form-control'])
    {

        $attributes = Collection::make($attributes);
        if (!$attributes->has('name')) {
            $attributes->put('name', $fieldName);
        }
        if (!$attributes->has('id')) {
            $attributes->put('id', $fieldName);
        }


        $stub = $this->files->get($this->getStub('text'));

        $this->replaceStubText($stub, "DUMMYFIELDNAME", $fieldName);
        $this->replaceStubText($stub, "DUMMYLABEL", $label);

        $this->setAttributeTextOfStub($stub, $attributes);
        $this->setErrorStubAndValue($stub, $fieldName);

        return $stub;
    }

    /**
     * get the text field using stub template
     *
     * @todo add attribute feature and etc
     *
     * @param  string $fieldName
     * @param  string $label
     * @param  array $attributes
     * @return $stub
     */
    public function radio($fieldName, $label = "", $value = 1, $attributes = [])
    {

        $stub = $this->files->get($this->getStub('radio'));

        $this->replaceStubText($stub, "DUMMYFIELDNAME", $fieldName);
        $this->replaceStubText($stub, "DUMMYLABEL", $label);
        $this->replaceStubText($stub, "DUMMYVALUE", $value);

        $this->setAttributeTextOfStub($stub, $attributes);
        $this->setErrorStubAndValue($stub, $fieldName, $updateValue = false);

        return $stub;
    }

    /**
     * get the text field using stub template
     *
     * @todo add attribute feature and etc
     *
     * @param  string $fieldName
     * @param  string $label
     * @param  array $attributes
     * @return $stub
     */
    public function file($fieldName, $label = "", $attributes = [])
    {

        $stub = $this->files->get($this->getStub('file'));

        $this->replaceStubText($stub, "DUMMYFIELDNAME", $fieldName);
        $this->replaceStubText($stub, "DUMMYLABEL", $label);

        $this->setAttributeTextOfStub($stub, $attributes);
        $this->setErrorStubAndValue($stub, $fieldName);

        return $stub;
    }

    /**
     * get the text field using stub template
     *
     * @todo add attribute feature and etc
     *
     * @param  string $fieldName
     * @param  string $label
     * @param  array $attributes
     * @return $stub
     */
    public function password($fieldName, $label = "", $attributes = ['class' => 'form-control'])
    {
        $attributes = Collection::make($attributes);
        $attributes->put('name', $fieldName);
        $attributes->put('id', $fieldName);

        $stub = $this->files->get($this->getStub('password'));

        $this->replaceStubText($stub, "DUMMYLABEL", $label);

        $this->setAttributeTextOfStub($stub, $attributes);
        $this->setErrorStubAndValue($stub, $fieldName, $updateValue = false);

        return $stub;
    }

    /**
     * get the text field using stub template
     *
     * @todo add attribute feature and etc
     *
     * @param  string $buttonText
     * @return $stub
     */
    public function setErrorStubAndValue(&$stub, $fieldName, $updateValue = true)
    {

        $errorClass = "";
        $dummyErrorMessageStub = "";
        $errors = $this->request->session()->get('errors');


        $value = $this->_getFieldValue($fieldName);


        if (NULL !== $errors && $errors->has($fieldName)) {
            $dummyErrorMessageStub = $this->files->get($this->getStub('error'));
            $this->replaceStubText($dummyErrorMessageStub, "DUMMYERRORMESSAGE", $errors->first($fieldName));
            $errorClass = "has-error";

            if ($this->request->session()->hasOldInput($fieldName)) {
                $value = $this->request->session()->getOldInput($fieldName);
            }
        }

        $this->replaceStubText($stub, "DUMMYERRORTEXT", $dummyErrorMessageStub);
        $this->replaceStubText($stub, "DUMMYERRORCLASS", $errorClass);
        if ($updateValue === false) {
            $value = "";
            //dd($value);
        }
        $this->replaceStubText($stub, "DUMMYVALUE", $value);

        return $this;
    }

    /**
     * get the text field using stub template
     *
     * @todo add attribute feature and etc
     *
     * @param  string $buttonText
     * @return $stub
     */
    public function setOptionTextOfStub(&$stub, $options = [], $fieldName, $value = null)
    {

        $optionsText = $this->getOptionText($options, $fieldName, $value);
        $this->replaceStubText($stub, "DUMMYOPTIONS", $optionsText);

        return $this;
    }

    /**
     * get the text field using stub template
     *
     * @todo add attribute feature and etc
     *
     * @param  string $buttonText
     * @return $stub
     */
    public function setAttributeTextOfStub(&$stub, $attributes)
    {
        $attributeText = $this->getAttributeText($attributes);
        $this->replaceStubText($stub, "DUMMYATTRIBUTES", $attributeText);

        return $this;
    }

    /**
     * get the text field using stub template
     *
     * @todo add attribute feature and etc
     *
     * @param  string $buttonText
     * @return $stub
     */
    public function submit($buttonText = "Save", $attributes = ['class' => 'btn btn-primary'])
    {
        $attributes = Collection::make($attributes);
        $stub = $this->files->get($this->getStub('submit'));

        $this->replaceStubText($stub, "DUMMYBUTTONTEXT", $buttonText);
        $this->setAttributeTextOfStub($stub, $attributes);

        return $stub;
    }

    /**
     * get the text field using stub template
     *
     * @todo add attribute feature and etc
     *
     * @param  string $buttonText
     * @return $stub
     */
    public function button($buttonText = "Save", $attributes = ['class' => 'btn btn-primary'])
    {
        $attributes = Collection::make($attributes);
        $stub = $this->files->get($this->getStub('button'));

        $this->replaceStubText($stub, "DUMMYBUTTONTEXT", $buttonText);
        $this->setAttributeTextOfStub($stub, $attributes);

        return $stub;
    }

    /**
     * get the attribuet text from given array
     *
     * @todo add attribute feature and etc
     *
     * @param  array $options
     * @return $stub
     */
    public function getOptionText($options = [], $fieldName = "", $fieldValue = NULL)
    {
        $optionText = "";

        if (null === $fieldValue) {
            $fieldValue = $this->_getFieldValue($fieldName);
        }

        foreach ($options as $attKey => $attVal) {

            if (is_array($fieldValue)) {
                $isSelectedValue = in_array($attKey, $fieldValue);
            } else {
                $isSelectedValue = ($attKey == $fieldValue) ? true : false;
            }
            if ($isSelectedValue) {
                $optionText .= "<option selected value='$attKey'> $attVal </option>";
            } else {
                $optionText .= "<option  value='$attKey'> $attVal </option>";
            }

        }

        return $optionText;
    }

    /**
     * get the attribuet text from given array
     *
     * @todo add attribute feature and etc
     *
     * @param  string $buttonText
     * @return $stub
     */
    public function getAttributeText($attributes = [])
    {
        $attributeText = "";
        unset($attributes['value']);

        foreach ($attributes as $attKey => $attVal) {
            if ($attVal === true) {
                $attributeText .= $attKey . " ";
            } elseif ($attVal === false) {
                $attributeText .= " ";
            } else {
                $attributeText .= $attKey . "='" . $attVal . "' ";
            }
        }

        return $attributeText;
    }


    /**
     * Replace the dummy stub textfor the given stub.
     *
     * @param  string $stub
     * @param  string $fieldName
     * @return $this
     */
    protected function replaceStubText(&$stub, $dummyText, $fieldName)
    {
        $stub = str_replace($dummyText, $fieldName, $stub);
        return $this;
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub($name)
    {
        return __DIR__ . "/stubs/{$name}.stub";
    }

    /**
     * Set the session store implementation.
     *
     * @param  \Illuminate\Contracts\Session\Session $session
     *
     * @return $this
     */
    public function setSessionStore(Session $session)
    {
        $this->session = $session;
        return $this;
    }


    private function _getFieldValue($fieldName)
    {
        $value = "";
        if (isset($this->model->$fieldName)) {
            $value = $this->model->$fieldName;
        } elseif (method_exists($this->model, 'get')) {
            $value = $this->model->get($fieldName);
        }

        return $value;
    }
}
