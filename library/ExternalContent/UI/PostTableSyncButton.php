<?php

namespace Municipio\ExternalContent\UI;

use Municipio\HooksRegistrar\Hookable;
use WpService\Contracts\AddAction;
use WpService\Contracts\EscHtml;
use WpService\Contracts\GetCurrentScreen;
use WpService\Contracts\NonceUrl;
use WpService\Contracts\SubmitButton;

/**
 * Class PostTableSyncButton
 *
 * This class adds a sync button to the post table in the WordPress admin.
 */
class PostTableSyncButton implements Hookable
{
/**
     * PageRowActionsSyncButton constructor.
     *
     * @param \Municipio\ExternalContent\Config\SourceConfig[] $sourceConfigs
     * @param AddAction&GetCurrentScreen&SubmitButton&NonceUrl $wpService
     */
    public function __construct(
        private array $sourceConfigs,
        private AddAction&GetCurrentScreen&SubmitButton&NonceUrl&EscHtml $wpService
    ) {
    }

    /**
     * @inheritDoc
     */
    public function addHooks(): void
    {
        $this->wpService->addAction('manage_posts_extra_tablenav', array($this, 'addSyncButton'));
    }

    /**
     * Add sync button to the post table.
     *
     * @param string $which
     */
    public function addSyncButton(string $which)
    {
        $postTypeHasExternalContentSource = array_filter(
            $this->sourceConfigs,
            fn($config) => $config->getPostType() === $this->wpService->getCurrentScreen()->post_type
        );

        if (empty($postTypeHasExternalContentSource)) {
            return;
        }

        $classes    = 'button button-primary';
        $label      = __('Sync all posts from remote source');
        $requestUri = $_SERVER['REQUEST_URI'] ?? '';
        $url        = $this->wpService->nonceUrl(
            $requestUri
        ) . '&' . \Municipio\ExternalContent\Sync\Triggers\TriggerSyncFromGetParams::GET_PARAM_TRIGGER;

        echo '<a class="' . $classes . '" href="' . $url . '">' . $label . '<a>';
    }
}