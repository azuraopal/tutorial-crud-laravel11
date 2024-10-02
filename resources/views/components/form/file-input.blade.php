@props([
  'name',
  'label',
  'validFileFormats',
  'maxFileSizeMB'
])

<div
x-data="{
    fileName: '',
    fileSize: '',
    handleFileChange(event) {
      const file = event.target.files[0];
      if (file) {
        this.fileName = file.name;
        this.fileSize = (file.size / 1024).toFixed(2) + ' KB'; // Convert bytes to KB
      }
    }
  }"
  class="flex w-full max-w-xl text-center flex-col gap-1"
>
    <span class="w-fit pl-0.5 text-sm text-neutral-600 dark:text-neutral-300">{{ $label }}</span>
    <div class="flex w-full flex-col items-center justify-center gap-2 rounded-md border border-dashed border-neutral-300 p-8 text-neutral-600 dark:border-neutral-700 dark:text-neutral-300">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-12 opacity-75">
          <path fill-rule="evenodd" d="M11.47 2.47a.75.75 0 0 1 1.06 0l4.5 4.5a.75.75 0 0 1-1.06 1.06l-3.22-3.22V16.5a.75.75 0 0 1-1.5 0V4.81L8.03 8.03a.75.75 0 0 1-1.06-1.06l4.5-4.5ZM3 15.75a.75.75 0 0 1 .75.75v2.25a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5V16.5a.75.75 0 0 1 1.5 0v2.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V16.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
        </svg>
        <div class="group">
            <label for="fileInputDragDrop" class="cursor-pointer font-medium text-black group-focus-within:underline dark:text-white">
                <input 
                    id="fileInputDragDrop" 
                    type="file" 
                    name="{{ $name }}"
                    class="sr-only" 
                    aria-describedby="validFileFormats" 
                    @change="handleFileChange($event)"
                />
                Browse
            </label>
             or drag and drop here
        </div>
        <small id="validFileFormats">{{ $validFileFormats }} - Max {{ $maxFileSizeMB }}MB</small>
    </div>
    <!-- Display file name and size when a file is selected -->
    <template x-if="fileName">
        <div class="text-sm text-neutral-600 dark:text-neutral-300">
            <p><strong>Selected File:</strong> <span x-text="fileName"></span></p>
            <p><strong>Size:</strong> <span x-text="fileSize"></span></p>
        </div>
    </template>
</div>
