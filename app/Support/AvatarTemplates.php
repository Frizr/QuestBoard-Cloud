<?php

namespace App\Support;

final class AvatarTemplates
{
    public const DEFAULT = 'human-vanguard';

    /**
     * @return array<string, array{name: string, title: string, role: string, accent: string, asset: string}>
     */
    public static function all(): array
    {
        return [
            'human-vanguard' => [
                'name' => 'Human Vanguard',
                'title' => 'Noble Battle-Mage',
                'role' => 'Seasoned warrior presence with fur mantle, staff, and violet rune glow.',
                'accent' => '#8B5CF6',
                'asset' => 'images/avatar-templates/human-vanguard.png',
            ],
            'elf-moonwarden' => [
                'name' => 'Elf Moonwarden',
                'title' => 'Ethereal Grove Sentinel',
                'role' => 'Silver hair, glowing eyes, ornate armor, and moonlit forest magic.',
                'accent' => '#38BDF8',
                'asset' => 'images/avatar-templates/elf-moonwarden.png',
            ],
            'drow-nightblade' => [
                'name' => 'Drow Nightblade',
                'title' => 'Cunning Underdark Duelist',
                'role' => 'Hooded dark-elf rogue with white hair, arcane armor, and violet dagger.',
                'accent' => '#8B5CF6',
                'asset' => 'images/avatar-templates/drow-nightblade.png',
            ],
            'half-elf-arcanist' => [
                'name' => 'Half-Elf Arcanist',
                'title' => 'Balanced Spell Envoy',
                'role' => 'Calm arcane caster in purple robes with a focused magical staff.',
                'accent' => '#8B5CF6',
                'asset' => 'images/avatar-templates/half-elf-arcanist.png',
            ],
            'half-orc-warbringer' => [
                'name' => 'Half-Orc Warbringer',
                'title' => 'Scarred Veteran',
                'role' => 'Close-framed armored fighter with tusks, scars, and intimidating resolve.',
                'accent' => '#A78BFA',
                'asset' => 'images/avatar-templates/half-orc-warbringer.png',
            ],
            'halfling-knife' => [
                'name' => 'Halfling Knife',
                'title' => 'Mischievous Tavern Scout',
                'role' => 'Warm tavern portrait with leather armor, sly smile, and a ready blade.',
                'accent' => '#FBBF24',
                'asset' => 'images/avatar-templates/halfling-knife.png',
            ],
            'dwarf-runeforger' => [
                'name' => 'Dwarf Runeforger',
                'title' => 'Blacksmith Guardian',
                'role' => 'Braided beard, forge fire, glowing runes, hammer, and heavy armor.',
                'accent' => '#F97316',
                'asset' => 'images/avatar-templates/dwarf-runeforger.png',
            ],
            'gnome-artificer' => [
                'name' => 'Gnome Artificer',
                'title' => 'Eccentric Tinkerer',
                'role' => 'Workshop inventor with goggles, clockwork tools, and crackling magic.',
                'accent' => '#22C55E',
                'asset' => 'images/avatar-templates/gnome-artificer.png',
            ],
            'tiefling-pyromancer' => [
                'name' => 'Tiefling Pyromancer',
                'title' => 'Infernal Flamecaller',
                'role' => 'Horned caster framed by fire, smoke, and a blackened staff.',
                'accent' => '#F97316',
                'asset' => 'images/avatar-templates/tiefling-pyromancer.png',
            ],
            'githyanki-astral-blade' => [
                'name' => 'Githyanki Astral Blade',
                'title' => 'Silver-Sword Vanguard',
                'role' => 'Astral ruins, sharp features, crown, silver armor, and luminous blade.',
                'accent' => '#CBD5E1',
                'asset' => 'images/avatar-templates/githyanki-astral-blade.png',
            ],
            'dragonborn-gold-warden' => [
                'name' => 'Dragonborn Gold Warden',
                'title' => 'Draconic Oath Bearer',
                'role' => 'Gold-scaled dragonborn in decorated armor with smoke and rune-lit stone.',
                'accent' => '#FBBF24',
                'asset' => 'images/avatar-templates/dragonborn-gold-warden.png',
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

    /**
     * @return array<int, string>
     */
    public static function validKeys(): array
    {
        return array_values(array_unique([...self::keys(), ...array_keys(self::aliases())]));
    }

    public static function normalize(?string $template): string
    {
        $key = (string) $template;

        if (array_key_exists($key, self::aliases())) {
            return self::aliases()[$key];
        }

        return array_key_exists($key, self::all()) ? $key : self::DEFAULT;
    }

    /**
     * @return array{name: string, title: string, role: string, accent: string, asset: string}
     */
    public static function find(?string $template): array
    {
        return self::all()[self::normalize($template)];
    }

    /**
     * @return array<string, string>
     */
    private static function aliases(): array
    {
        return [
            'shadow-mage' => 'half-elf-arcanist',
            'arcane-mage' => 'half-elf-arcanist',
            'iron-paladin' => 'human-vanguard',
            'moon-ranger' => 'elf-moonwarden',
            'ember-rogue' => 'drow-nightblade',
            'frost-cleric' => 'elf-moonwarden',
            'crimson-knight' => 'half-orc-warbringer',
            'necromancer-scholar' => 'drow-nightblade',
            'golden-bard' => 'halfling-knife',
            'shadow-assassin' => 'drow-nightblade',
            'dragon-herald' => 'dragonborn-gold-warden',
        ];
    }
}
