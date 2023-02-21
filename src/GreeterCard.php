<?php

namespace Orion\NovaGreeter;

use Laravel\Nova\Card;

class GreeterCard extends Card
{
    public bool $button = false;

    public bool $avatar = false;

    public function __construct($component = null)
    {
        parent::__construct($component);

        $this->withMeta([
            'user_name' => auth()->user()?->name ?? __('Dear User'),
        ]);
    }

    public function user(?string $name = null, ?string $title = null): static
    {
        return $this->withMeta([
            'user_name' => $name ?? (auth()->user()?->name ?? __('Dear User')),
            'user_title' => $title,
        ]);
    }

    public function message(string $text): static
    {
        return $this->withMeta(['message' => $text]);
    }

    public function avatar(string $url): static
    {
        $this->avatar = true;

        if ($this->width === $this::ONE_THIRD_WIDTH || $this->width === $this::ONE_QUARTER_WIDTH) {
            $this->width($this::ONE_HALF_WIDTH);
        }

        if ($this->button) {
            $this->width($this::TWO_THIRDS_WIDTH);
        }

        return $this->withMeta(['avatar' => true, 'avatar_url' => $url]);
    }

    public function button(string $name, string $target, ?string $style = null): static
    {
        $this->button = true;

        if ($this->width === $this::ONE_THIRD_WIDTH || $this->width === $this::ONE_QUARTER_WIDTH) {
            $this->width($this::ONE_HALF_WIDTH);
        }

        if ($this->avatar) {
            $this->width($this::TWO_THIRDS_WIDTH);
        }

        return $this->withMeta([
            'button' => true,
            'button_name' => $name,
            'button_target' => $target,
            'button_style' => $style,
        ]);
    }

    public function stats(array $stats): static
    {
        if ($this->width === $this::ONE_THIRD_WIDTH || $this->width === $this::ONE_QUARTER_WIDTH) {
            $this->width($this::ONE_HALF_WIDTH);
        }

        if (count($stats) > 3) {
            $stats = array_slice($stats, 0, 3);
        }

        return $this->withMeta(['stats' => $stats]);
    }

    public function verified(bool $verified = true, ?string $text = null): static
    {
        return $this->withMeta(['verified' => $verified, 'verified_text' => $text]);
    }

    public function style(?string $extend = null, ?string $override = null): static
    {
        return $this->withMeta(['style_extend' => $extend, 'style_override' => $override]);
    }

    public function component(): string
    {
        return 'nova-greeter';
    }
}