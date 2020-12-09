<script src={{asset("js/jquery-3.4.1.js")}}></script>
<script src={{asset("js/bootstrap.min.js")}}></script>
<script src="{{asset('js/jquery-datepicker.js')}}"></script>
<script src="{{asset('js/jquery-ui.js')}}"></script>
<script>
    function myFunction() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>

<!--index countries -->
<script>
    function myFunction() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>


<!-- get dropdown with filter -->
<script>
    $(document).ready(function () {
        $('select[name="country"]').on('change',function () {
            var country_id = $(this).val();

            if(country_id){
                //console.log(country_id);
                $.ajax({
                    url: '/Admin/getCities/' + country_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        // console.log(data);
                        $('select[name="city"]').empty();
                        // loop through the data
                        $.each(data,function (key,value) {
                            //  console.log(key);
                            $('select[name="city"]').append('<option value="'+key+'">' + value + '</option>');
                            /*$('select[name="city"]').on('change',function () {
                                var city_id = $(this).val();
                                console.log(city_id);
                            })*/
                        })
                    }
                })
            }else {
                ('select[name="city"]').empty();
            }
        })

        $('select[name="destcountry"]').on('change',function () {
            var country_id = $(this).val();

            if(country_id){
                //console.log(country_id);
                $.ajax({
                    url: '/Admin/getDestCities/' + country_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        // console.log(data);
                        $('select[name="destcity"]').empty();
                        // loop through the data
                        $.each(data,function (key,value) {
                            //  console.log(key);
                            $('select[name="destcity"]').append('<option value="'+key+'">' + value + '</option>');
                            /*$('select[name="city"]').on('change',function () {
                                var city_id = $(this).val();
                                console.log(city_id);
                            })*/
                        })
                    }
                })
            }else {
                ('select[name="destcity"]').empty();
            }
        })

        $('select[name="country"]').on('change',function () {
            var country_id = $(this).val();

            if(country_id){
                //console.log(country_id);
                $.ajax({
                    url: '/Admin/Hotel/getCities/' + country_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        // console.log(data);
                        $('select[name="city"]').empty();
                        // loop through the data
                        $.each(data,function (key,value) {
                            //  console.log(key);
                            $('select[name="city"]').append('<option value="'+key+'">' + value + '</option>');
                            /*$('select[name="city"]').on('change',function () {
                                var city_id = $(this).val();
                                console.log(city_id);
                            })*/
                        })
                    }
                })
            }else {
                ('select[name="city"]').empty();
            }
        })
    })
</script>

<script>
    $( function() {
        $( "#datepicker" ).datepicker({ dateFormat: "dd/mm/yy",minDate: 0});
        // $( "#datepicker" ).datepicker({ minDate: 0});

    } );

</script>


