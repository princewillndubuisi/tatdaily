<div>
    <form wire:submit.prevent="updatePhoto" enctype="multipart/form-data" style="display:none;">
        @csrf
        <input type="file" id="profile-picture-input" wire:model="photo" accept="image/*">
    </form>

    <!-- Change Picture Link -->
    <x-dropdown-link href="#" onclick="document.getElementById('profile-picture-input').click(); return false;">
        {{ __('Change Picture') }}
    </x-dropdown-link>

    <!-- Feedback Message -->
    @if (session()->has('message'))
        <div class="text-green-500">{{ session('message') }}</div>
    @endif
</div>
