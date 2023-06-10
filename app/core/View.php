<?php

namespace app\core;

class View
{
    const VIEWS_DIR = '..'.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'views';
    const TEMPLATES_PATH = self::VIEWS_DIR.'templates';
    protected string $template = 'main';
    protected string $page;


    public function __construct(string $template = null)
    {
        if (!is_null($template))
        {
            $this->template = $template;
        }
    }


    /**
     * @param string $page
     * @param array $data
     * @return void
     */
    public function render(string $page, array $data = []): void
    {
        extract($data);
        $this->page = $page;
        include_once $this->getTemplatePath();
    }


    /**
     * @return string
     */
    private function getTemplatePath(): string
    {
        return self::TEMPLATES_PATH.DIRECTORY_SEPARATOR.$this->template.'.php';
    }
}