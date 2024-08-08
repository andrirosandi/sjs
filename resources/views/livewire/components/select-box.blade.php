<div>
    <div id="listbox-appselectbox">
      <label id="listbox-label-appselectbox" class="block text-sm font-medium leading-6 text-gray-900">Assigned to</label>
      <div id="listbox-container-appselectbox" class="relative mt-2">
        <button id="listbox-button-appselectbox" type="button" class="relative w-full cursor-default rounded-md bg-white py-1.5 pl-3 pr-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-sm sm:leading-6" aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label-appselectbox" aria-activedescendant="listbox-option-0-appselectbox" tabindex="0">
          <span id="selected-caption-appselectbox" class="flex items-center">
            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" class="h-5 w-5 flex-shrink-0 rounded-full">
            <span id="listbox-selected-appselectbox" class="ml-3 block truncate">Tom Cook</span>
          </span>
          <span class="pointer-events-none absolute inset-y-0 right-0 ml-3 flex items-center pr-2">
            <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z" clip-rule="evenodd" /></svg>
          </span>
        </button>
        <ul id="listbox-options-appselectbox" hidden class="absolute z-10 mt-1 max-h-56 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm" tabindex="-1" role="listbox" aria-labelledby="listbox-label-appselectbox" aria-activedescendant="listbox-option-3">
          <li id="listbox-option-0-appselectbox" data-value="Wade Cooper" class="text-gray-900 relative cursor-default select-none hover:bg-purple-200 py-2 pl-3 pr-9 listbox-option-appselectbox " role="option">
            <div class="caption-appselectbox flex items-center">
              <img src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" class="h-5 w-5 flex-shrink-0 rounded-full">
              <span class="font-normal ml-3 block truncate">Wade Cooper</span>
            </div>
            
            <span id="checked-0-appselectbox" class="checked-appselectbox text-indigo-600 absolute inset-y-0 right-0 flex items-center pr-4">
                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" /></svg>
            </span>
          </li>
          <li id="listbox-option-1-appselectbox" data-value="Xyuan" class="text-gray-900 relative cursor-default select-none hover:bg-purple-200 py-2 pl-3 pr-9 listbox-option-appselectbox " role="option">
            <div class="caption-appselectbox flex items-center">
              <img src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" class="h-5 w-5 flex-shrink-0 rounded-full">
              <span class="font-normal ml-3 block truncate">Xyuan</span>
            </div>
            
            <span id="checked-1-appselectbox" class="checked-appselectbox text-indigo-600 absolute inset-y-0 right-0 flex items-center pr-4">
                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" /></svg>
            </span>
          </li>
          <!-- More items... -->
        </ul>
        <input type="text" id="appselectbox" name="appselectbox" value="Xyuan">
      </div>

    </div>
  <script>
    document.getElementById('listbox-button-appselectbox').addEventListener('click', function () {
      const listboxOptions = document.getElementById('listbox-options-appselectbox');
      listboxOptions.hidden = !listboxOptions.hidden;
    });

    document.addEventListener('DOMContentLoaded', function() {
        const listOptions = document.querySelectorAll('.listbox-option-appselectbox');

        listOptions.forEach(function(option) {
            option.addEventListener('click', function() {
            const selectedValue = this.getAttribute('data-value');
            document.getElementById('appselectbox').value = selectedValue;
            document.getElementById('listbox-options-appselectbox').hidden = true; // Menyembunyikan daftar setelah nilai diatur
            });
        });

        
        const appselectbox = document.getElementById('appselectbox');

        // Event listener untuk memeriksa nilai saat halaman dimuat
        const selectedValue = appselectbox.value;
        // const listOptions = document.querySelectorAll('.listbox-option-appselectbox');

        listOptions.forEach(function(option) {
        if (option.getAttribute('data-value') === selectedValue) {
            const caption = option.querySelector('.caption-appselectbox').innerHTML;
            document.getElementById('selected-caption-appselectbox').innerHTML = caption;
        }
        });

        // Event listener untuk ketika opsi dipilih
        // const listOptions = document.querySelectorAll('.listbox-option-appselectbox');
        listOptions.forEach(function(option) {
        option.addEventListener('click', function() {
            const selectedValue = this.getAttribute('data-value');
            const caption = this.querySelector('.caption-appselectbox').innerHTML;
            appselectbox.value = selectedValue;
            document.getElementById('selected-caption-appselectbox').innerHTML = caption;
            document.getElementById('listbox-options-appselectbox').hidden = true;


            // Sembunyikan semua .checked-appselectbox
            const checkedAppSelectBoxes = document.querySelectorAll('.checked-appselectbox');
            checkedAppSelectBoxes.forEach(function(checkbox) {
            checkbox.style.display = 'none';
            });

            // Tampilkan .checked-appselectbox pada .listbox-option-appselectbox yang terpilih
            const selectedOption = document.querySelector('.listbox-option-appselectbox[data-value="' + selectedValue + '"]');
            const checkedAppSelectBox = selectedOption.querySelector('.checked-appselectbox');
            checkedAppSelectBox.style.display = 'flex';
        });
        });

        // Sembunyikan semua .checked-appselectbox
        const checkedAppSelectBoxes = document.querySelectorAll('.checked-appselectbox');
        checkedAppSelectBoxes.forEach(function(checkbox) {
        checkbox.style.display = 'none';
        });

        // Tampilkan .checked-appselectbox pada .listbox-option-appselectbox yang terpilih
        const selectedOption = document.querySelector('.listbox-option-appselectbox[data-value="' + selectedValue + '"]');
        const checkedAppSelectBox = selectedOption.querySelector('.checked-appselectbox');
        checkedAppSelectBox.style.display = 'flex';



        
    });

    document.addEventListener('keydown', function(event) {
  const listboxOptions = document.getElementById('listbox-options-appselectbox');
  let activeDescendant = listboxOptions.querySelector('.listbox-option-appselectbox--focus');

  if (!activeDescendant) {
    // If no option is currently focused, use the first option as the active descendant
    activeDescendant = listboxOptions.firstElementChild;
  }

  switch (event.key) {
    case 'ArrowDown':
      event.preventDefault();
      if (activeDescendant.nextElementSibling) {
        activeDescendant.nextElementSibling.focus();
        activeDescendant = activeDescendant.nextElementSibling;
      } else {
        listboxOptions.lastElementChild.focus();
        activeDescendant = listboxOptions.lastElementChild;
      }
      break;
    case 'ArrowUp':
      event.preventDefault();
      if (activeDescendant.previousElementSibling) {
        activeDescendant.previousElementSibling.focus();
        activeDescendant = activeDescendant.previousElementSibling;
      } else {
        listboxOptions.firstElementChild.focus();
        activeDescendant = listboxOptions.firstElementChild;
      }
      break;
    case 'Enter':
      event.preventDefault();
      activeDescendant.click();
      break;
    default:
      break;
  }
});

    




   
  </script>
  </div>
  