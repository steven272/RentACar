function get_data_table(page, perPage) {
    page = page || 1;
    perPage = perPage || 5;

    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'ajaxRouter.php?page=' + page + '&perPage=' + perPage, true);

    xhr.onreadystatechange = function () {
        try {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {

                    var obj = JSON.parse(xhr.responseText);

                    $('tbody').html("");

                    obj.DataTable.forEach(function (idx, obj) {
                        $('tbody').append('<tr><td>' + idx.type_car + '</td><td>' + idx.first_name + '</td><td>' + idx.last_name + '</td><td>' + idx.email + '</td><td>' + idx.mobile_number + '</td><td>' + idx.age + '</td><td>' + idx.pay_method + '</td></tr>');
                    });

                    $('.pagination').html("");

                    previous = obj.pageNumber - 1;
                    next = obj.pageNumber + 1;

                   if(previous >= 1) {
                        $('.pagination').append("<li class='paginate_button previous'><button type='button' class='btn btn-primary btn-flat' onclick='get_data_table(" + previous + "," + perPage + ")'>Previous</button></li>");
                   }

                    for(var x=1; x<=obj.pages; x++) {
                        $('.pagination').append("<li class='paginate_button'><button id='add-new-event' type='button' class='btn btn-primary btn-flat' onclick='get_data_table(" + x + "," + perPage + ")'>"+x+"</button></li>");
                    }

                    if(next <= obj.pages) {
                        $('.pagination').append("<li class='paginate_button next'><button type='button' class='btn btn-primary btn-flat' onclick='get_data_table(" + next + "," + perPage + ")'>Next</button></li>");
                    }

                    getSelectItems(page, perPage);

                } else {
                    alert('We experiencing some problems with the request.');
                }
            }
        }
        catch(e) {
            alert('Loading DataTable content failed');
        }
    };

    xhr.send();
}

get_data_table();

function getSelectItems(page, perPage) {

    var item = document.getElementById('SelectOption');

    item.addEventListener('change', function () {
            perPage = item.value;
            get_data_table(page, perPage);
    });
}