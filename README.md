# Flux Clone UI

A beautiful Blade UI component library for Laravel & Livewire - A Flux UI alternative.

## Installation

Install the package via Composer:

```bash
composer require flux-clone/ui
```

The package will auto-register its service provider.

## Requirements

- PHP 8.2+
- Laravel 11+ or 12+
- Livewire 3+
- Tailwind CSS 4+
- Alpine.js (included with Livewire)

## Configuration

### Tailwind CSS

Add the package's view path to your `tailwind.config.js` (or CSS for Tailwind 4):

```css
/* For Tailwind 4 - add to your app.css */
@source "../vendor/flux-clone/ui/resources/views/**/*.blade.php";
```

Or for legacy Tailwind config:

```javascript
export default {
  content: [
    // ... your existing paths
    "./vendor/flux-clone/ui/resources/views/**/*.blade.php",
  ],
};
```

## Usage

All components use the `flux-clone` namespace:

```blade
<x-flux-clone::button variant="primary">Click me</x-flux-clone::button>

<x-flux-clone::input name="email" label="Email" type="email" />

<x-flux-clone::modal name="confirm">
    <x-flux-clone::heading>Confirm Action</x-flux-clone::heading>
    <x-flux-clone::text>Are you sure?</x-flux-clone::text>
    <x-flux-clone::modal.close>
        <x-flux-clone::button>Cancel</x-flux-clone::button>
    </x-flux-clone::modal.close>
</x-flux-clone::modal>
```

## Available Components

### Form Components

- `<x-flux-clone::button>` - Buttons with variants (primary, danger, ghost, subtle, outline, filled)
- `<x-flux-clone::input>` - Input fields with label, error handling, password visibility
- `<x-flux-clone::textarea>` - Textarea with label and error handling
- `<x-flux-clone::select>` - Select dropdown with custom styling
- `<x-flux-clone::checkbox>` - Checkbox with label and description
- `<x-flux-clone::radio>` - Radio button with icon support
- `<x-flux-clone::radio.group>` - Radio group with segmented variant
- `<x-flux-clone::toggle>` - Toggle switch
- `<x-flux-clone::field>` - Field wrapper for form elements

### Typography

- `<x-flux-clone::heading>` - Heading with sizes (xs, sm, base, lg, xl, 2xl)
- `<x-flux-clone::subheading>` - Subheading text
- `<x-flux-clone::text>` - Body text

### Layout

- `<x-flux-clone::card>` - Card container
- `<x-flux-clone::separator>` - Horizontal/vertical separator
- `<x-flux-clone::navbar>` - Navigation bar
- `<x-flux-clone::navlist>` - Navigation list
- `<x-flux-clone::navlist.item>` - Navigation list item

### Overlays

- `<x-flux-clone::modal>` - Modal dialog with Alpine.js
- `<x-flux-clone::modal.trigger>` - Modal trigger
- `<x-flux-clone::modal.close>` - Modal close button
- `<x-flux-clone::dropdown>` - Dropdown menu
- `<x-flux-clone::tooltip>` - Tooltip with position options

### Data Display

- `<x-flux-clone::table>` - Table with striped, hoverable options
- `<x-flux-clone::table.head>` - Table header
- `<x-flux-clone::table.body>` - Table body
- `<x-flux-clone::table.row>` - Table row
- `<x-flux-clone::table.cell>` - Table cell with sortable support
- `<x-flux-clone::badge>` - Badge with colors and variants
- `<x-flux-clone::avatar>` - Avatar with image or initials

### Feedback

- `<x-flux-clone::callout>` - Callout/Alert with types (info, success, warning, danger)
- `<x-flux-clone::skeleton>` - Loading skeleton

### Other

- `<x-flux-clone::icon>` - Icon component (supports Heroicons)
- `<x-flux-clone::link>` - Styled link

## Component Examples

### Button Variants

```blade
<x-flux-clone::button variant="primary">Primary</x-flux-clone::button>
<x-flux-clone::button variant="danger">Danger</x-flux-clone::button>
<x-flux-clone::button variant="ghost">Ghost</x-flux-clone::button>
<x-flux-clone::button variant="subtle">Subtle</x-flux-clone::button>
<x-flux-clone::button variant="outline">Outline</x-flux-clone::button>

{{-- With icons --}}
<x-flux-clone::button icon="check" variant="primary">Save</x-flux-clone::button>

{{-- Sizes --}}
<x-flux-clone::button size="xs">Extra Small</x-flux-clone::button>
<x-flux-clone::button size="sm">Small</x-flux-clone::button>
<x-flux-clone::button size="lg">Large</x-flux-clone::button>
```

### Input with Password Toggle

```blade
<x-flux-clone::input
    name="password"
    type="password"
    label="Password"
    viewable
/>
```

### Table with Sorting

```blade
<x-flux-clone::table striped hoverable>
    <x-flux-clone::table.head>
        <x-flux-clone::table.row>
            <x-flux-clone::table.cell header sortable="name">Name</x-flux-clone::table.cell>
            <x-flux-clone::table.cell header sortable="email">Email</x-flux-clone::table.cell>
            <x-flux-clone::table.cell header>Actions</x-flux-clone::table.cell>
        </x-flux-clone::table.row>
    </x-flux-clone::table.head>
    <x-flux-clone::table.body>
        @foreach($users as $user)
            <x-flux-clone::table.row>
                <x-flux-clone::table.cell>{{ $user->name }}</x-flux-clone::table.cell>
                <x-flux-clone::table.cell>{{ $user->email }}</x-flux-clone::table.cell>
                <x-flux-clone::table.cell>
                    <x-flux-clone::button size="sm" variant="ghost">Edit</x-flux-clone::button>
                </x-flux-clone::table.cell>
            </x-flux-clone::table.row>
        @endforeach
    </x-flux-clone::table.body>
</x-flux-clone::table>
```

### Modal with Livewire

```blade
{{-- Using wire:model --}}
<x-flux-clone::modal wire:model="showModal">
    <x-flux-clone::heading>Modal Title</x-flux-clone::heading>
    <x-flux-clone::text>Modal content here...</x-flux-clone::text>

    <div class="flex justify-end gap-2 mt-4">
        <x-flux-clone::button wire:click="$set('showModal', false)" variant="ghost">
            Cancel
        </x-flux-clone::button>
        <x-flux-clone::button wire:click="save" variant="primary">
            Save
        </x-flux-clone::button>
    </div>
</x-flux-clone::modal>

{{-- Or using named modals --}}
<x-flux-clone::modal.trigger name="confirm-delete">
    <x-flux-clone::button variant="danger">Delete</x-flux-clone::button>
</x-flux-clone::modal.trigger>

<x-flux-clone::modal name="confirm-delete">
    <x-flux-clone::heading>Confirm Delete</x-flux-clone::heading>
    <x-flux-clone::text>Are you sure you want to delete this item?</x-flux-clone::text>
</x-flux-clone::modal>
```

## Customization

### Publishing Views

To customize component views:

```bash
php artisan vendor:publish --tag=flux-clone-views
```

Views will be published to `resources/views/vendor/flux-clone`.

### Using with Blade Icons

For full icon support, install Blade Icons:

```bash
composer require blade-ui-kit/blade-heroicons
```

Then use icons by name:

```blade
<x-flux-clone::icon name="check" />
<x-flux-clone::icon name="arrow-right" variant="solid" />
```

## Dark Mode

All components support dark mode out of the box. They use Tailwind's `dark:` prefix, so ensure your app is configured for dark mode:

```html
<!-- In your HTML or layout -->
<html class="dark"></html>
```

Or use JavaScript to toggle:

```javascript
document.documentElement.classList.toggle("dark");
```

## License

MIT License
