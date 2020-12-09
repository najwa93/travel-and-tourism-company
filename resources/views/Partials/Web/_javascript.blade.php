
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{asset('js/jquery-3.4.1.js')}}"></script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
{{--
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
--}}
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/jquery-datepicker.js')}}"></script>
<script src="{{asset('js/jquery-ui.js')}}"></script>



<script>
    // Get the modal
    var modal = document.getElementById('id01');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
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
            td = tr[i].getElementsByTagName("td")[1];
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
<script>
    $(document).ready(function(){
        $("#myBtn").click(function(){
            $("#myModal").modal();
        });
    });
</script>

<script>
    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }
</script>

<script type="text/javascript">
    $(document).ready(function(){
        var url = document.location.toString();
        if (url.match('#')) {
            $('.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show');
        }


    });
</script>
<script>
    $( function() {
        $( "#datepicker" ).datepicker({ dateFormat: "dd/mm/yy",minDate: 0});
       // $( "#datepicker" ).datepicker({ minDate: 0});

    } );

    $( function() {
        $( "#datepicker1" ).datepicker({  dateFormat: "dd/mm/yy",minDate: 0});
    } );

    $( function() {
        $( "#datepicker-f" ).datepicker({  dateFormat: "dd/mm/yy",minDate: 0});
    } );

    $( function() {
        $( "#datepicker-flight" ).datepicker({  dateFormat: "dd/mm/yy",minDate: 0});
    } );
</script>
