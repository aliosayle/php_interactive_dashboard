$(document).ready(function () {
    $('.dropdown').each(function () {
        let dropdown = $(this);
        let searchInput = dropdown.find('.search');
        let toggleButton = dropdown.find('.toggleDropdown');
        let dropdownContent = dropdown.find('.dropdown-content');
        let keyfieldLabel = dropdown.find('.keyfield-label');

        let tableGuid = dropdown.data('table-guid');
        let keyfieldGuid = dropdown.data('keyfield-guid');
        let listfieldGuid = dropdown.data('listfield-guid');
        let fixedListGuid = dropdown.data('fixed-list-guid');
        let allowClearGuid = dropdown.data('allow-clear-guid');
        let searchValue = '';
        let page = 1;
        let isFetching = false;
        const limit = 10;

        function fetchDropdownData(reset = false) {
            if (isFetching) return;
            isFetching = true;

            $.ajax({
                url: 'backend/db_lookup_data.php',
                method: 'GET',
                data: {
                    search: searchValue,
                    page,
                    table_guid: tableGuid,
                    keyfield_guid: keyfieldGuid,
                    listfield_guid: listfieldGuid,
                    fixed_list_guid: fixedListGuid,
                    allow_clear_guid: allowClearGuid,
                },
                dataType: 'json',
                success: function (response) {
                    const { total, data, fixed_list, allow_clear } = response;

                    if (reset) {
                        dropdownContent.empty();
                        page = 1;
                    }

                    // if (data.length > 0) {
                    //     data.forEach(item => {
                    //         dropdownContent.append(
                    //             `<a href="#" data-key="${item[keyfieldGuid]}">${item[listfieldGuid]}</a>`
                    //         );
                    //     });
                    //     page++;
                    // }

                    if (data.length > 0) {
                        data.forEach(item => {
                            console.log(item[keyfieldGuid]); // Logs each item[keyfieldGuid] to the console
                        });
                    
                    
                            page++;

                    }
                    

                    dropdownContent.show();
                    isFetching = false;

                    // Store parameters
                    dropdown.data('fixed-list', fixed_list);
                    dropdown.data('allow-clear', allow_clear);
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching data:', error);
                    isFetching = false;
                }
            });
        }

        searchInput.on('input', function () {
            const fixedList = dropdown.data('fixed-list');

            if (fixedList) {
                searchInput.val('');
                return;
            }

            searchValue = $(this).val().trim();
            if (searchValue.length > 0) {
                fetchDropdownData(true);
            } else {
                dropdownContent.empty().hide();
            }
        });

        toggleButton.on('click', function () {
            // Log when the button is clicked
            console.log('Toggle button clicked');
            
            // Log the value of searchInput
            searchValue = searchInput.val().trim();
            console.log('Search value:', searchValue);
            
            // Log the call to fetchDropdownData
            console.log('Calling fetchDropdownData with reset = true');
            
            fetchDropdownData(true);
        });
        

        dropdownContent.on('click', 'a', function (e) {
            e.preventDefault();
            const selectedKey = $(this).data('key');
            const selectedText = $(this).text();

            searchInput.val(selectedText);
            keyfieldLabel.text(`KeyField: ${selectedKey}`);
            dropdownContent.hide();
        });

        dropdownContent.on('scroll', function () {
            if (
                $(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight
            ) {
                fetchDropdownData();
            }
        });

        searchInput.on('keydown', function (e) {
            const allowClear = dropdown.data('allow-clear');

            if (e.key === 'Delete' && allowClear) {
                searchInput.val('');
                keyfieldLabel.text('KeyField: None');
            }
        });

        $(document).click(function (e) {
            if (!$(e.target).closest(dropdown).length) {
                dropdownContent.hide();
            }
        });
    });
});