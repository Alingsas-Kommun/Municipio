<?php

namespace Municipio\Controller\Navigation;

interface MenuConfigInterface
{
    public function getIdentifier(): string;
    public function getMenuName(): string;
    public function getPageId(): ?int;
    public function getWpdb();
    public function getFallbackToPageTree(): bool;
    public function getIncludeTopLevel(): bool;
    public function getOnlyKeepFirstLevel(): bool;
    public function getContext(): string;
}