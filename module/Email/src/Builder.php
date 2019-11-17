<?php

namespace Email;

use Sebaks\View\ViewBuilder;
use Sebaks\View\Config;
use Interop\Container\ContainerInterface;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Model\ModelInterface;

class Builder
{
    /**
     * @var ContainerInterface
     */
    private $serviceManager;

    /**
     * @var array
     */
    private $emailView;

    /**
     * @var PhpRenderer
     */
    private $renderer;

    /**
     * @param ContainerInterface $serviceManager
     * @param array $emailView
     * @param PhpRenderer $renderer
     */
    public function __construct(
        ContainerInterface $serviceManager,
        array $emailView,
        PhpRenderer $renderer
    ) {
        $this->serviceManager = $serviceManager;
        $this->emailView = $emailView;
        $this->renderer = $renderer;
    }

    public function build($templateId, array $data = [])
    {
        $emailViewConfig = $this->emailView['contents'][$templateId];

        $config = new Config(array_merge(
            $this->emailView['layouts'],
            $this->emailView['contents'],
            $this->emailView['blocks']
        ));
        $contentConfig = $config->applyInheritance($emailViewConfig);
        $layoutConfig = $this->emailView['layouts'][$contentConfig['layout']];
        $layoutConfig['children']['content'] = $contentConfig;

        $viewBuilder = new ViewBuilder($config, $this->serviceManager);

        $viewModel = $viewBuilder->build($layoutConfig, $data);
        $viewModel->setTerminal(true);

        return $this->render($viewModel);
    }

    public function buildSubject($templateId, array $data = [])
    {
        $subject = Template::$subjectArray[$templateId];

        foreach ($data as $varName => $varValue) {
            $subject = str_replace('{' . $varName . '}', $varValue, $subject);
        }

        return $subject;
    }

    public function render(ModelInterface $model)
    {
        if ($model->hasChildren()) {
            $this->renderChildren($model);
        }

        $rendered = $this->renderer->render($model);

        return $rendered;
    }

    protected function renderChildren($model)
    {
        /** @var ModelInterface $child */
        foreach ($model as $child) {
            if ($child->terminate()) {
                throw new \Zend\View\Exception\DomainException('Inconsistent state; child view model is marked as terminal');
            }

            $result  = $this->render($child);
            $capture = $child->captureTo();
            if (!empty($capture)) {
                if ($child->isAppend()) {
                    $oldResult=$model->{$capture};
                    $model->setVariable($capture, $oldResult . $result);
                } else {
                    $model->setVariable($capture, $result);
                }
            }
        }
    }
}
