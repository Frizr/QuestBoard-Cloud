<?php

namespace App\Support;

final class AvatarTemplates
{
    public const DEFAULT = 'shadow-mage';

    /**
     * @return array<string, array{name: string, title: string, accent: string, robe: string, skin: string, mark: string}>
     */
    public static function all(): array
    {
        return [
            'shadow-mage' => [
                'name' => 'Shadow Mage',
                'title' => 'Arcane Strategist',
                'accent' => '#8B5CF6',
                'robe' => '#312E81',
                'skin' => '#B98A68',
                'mark' => 'rune',
            ],
            'iron-paladin' => [
                'name' => 'Iron Paladin',
                'title' => 'Oath Keeper',
                'accent' => '#FBBF24',
                'robe' => '#475569',
                'skin' => '#D6A77F',
                'mark' => 'shield',
            ],
            'moon-ranger' => [
                'name' => 'Moon Ranger',
                'title' => 'Wild Pathfinder',
                'accent' => '#22C55E',
                'robe' => '#14532D',
                'skin' => '#C99A72',
                'mark' => 'leaf',
            ],
            'ember-rogue' => [
                'name' => 'Ember Rogue',
                'title' => 'Silent Blade',
                'accent' => '#B45309',
                'robe' => '#7F1D1D',
                'skin' => '#A86F4E',
                'mark' => 'blade',
            ],
            'frost-cleric' => [
                'name' => 'Frost Cleric',
                'title' => 'Dawn Healer',
                'accent' => '#38BDF8',
                'robe' => '#0F766E',
                'skin' => '#D8B896',
                'mark' => 'star',
            ],
            'crimson-knight' => [
                'name' => 'Crimson Knight',
                'title' => 'Boss Slayer',
                'accent' => '#DC2626',
                'robe' => '#991B1B',
                'skin' => '#C88F68',
                'mark' => 'crown',
            ],
        ];
    }

    /**
     * @return array<int, string>
     */
    public static function keys(): array
    {
        return array_keys(self::all());
    }

    public static function normalize(?string $template): string
    {
        $key = (string) $template;

        return array_key_exists($key, self::all()) ? $key : self::DEFAULT;
    }
}
