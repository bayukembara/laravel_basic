<div class="mb-6">
    <label class="block">
        <span class="text-gray-700">Title</span>
        <input type="text" name="title" class="block @error('title') border-red-500 @enderror w-full mt-1 rounded-md"
            placeholder="" value="{{ old('title') }}" />
    </label>
    @error('title')
        <div class="text-sm text-red-600">{{ $message }}</div>
    @enderror
</div>
<div class="mb-6">
    <label class="block">
        <span class="text-gray-700">Content</span>
        <textarea class="block @error('content') border-red-500 @enderror w-full mt-1 rounded-md" name="content" rows="3">{{ old('content') }}</textarea>
    </label>
    @error('content')
        <div class="text-sm text-red-600">{{ $message }}</div>
    @enderror
</div>
<button type="submit" class="text-white bg-blue-600  rounded text-sm px-5 py-2.5">Submit</button>

</form>
