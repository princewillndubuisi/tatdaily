<div>
    <h1 class="text-[12px] font-medium sm:font-medium">Categories</h1>

    @foreach ($this->category as $category)
        <div class="flex items-center gap-2 round-md mt-6 sm:gap-6">
            <input type="checkbox" class="w-[16px] h-[15px] rounded-md sm:w-5 sm:h-5"  value="{{ $category->id }}" wire:model='CheckCategories' wire:change='SelectedCategories'>
            <label for="" class="text-[10px] ml-4 text-gray-500 font-medium sm:text-sm sm:text-princess sm:ml-0 sm:font-medium">{{ $category->title }}</label>
        </div>
    @endforeach

</div>
