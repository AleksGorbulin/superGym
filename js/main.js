const sendRequest = (pid, rat) => {
    console.log('productid' + pid + ' rating = ' + rat);
    $.get("insertrating.php?rating=" + rat + "&product=" + pid, function (data, status) {
        var response = data.trim();
        if (response == 'no') {
            $("#response" + pid).html("<p style='font-size:0.8rem;' class='text-muted'>you have already rated this item!</p>");
        } else {
            $("#response" + pid).html(response);
        }
    });
}


$(document).ready(function () {
    $("#usr").keyup(function () {
        const qry = $("#usr").val();
        console.log('qry = ' + qry);
        $.get("filter.php?qry=" + qry, function (data, status) {
            console.log('data is ' + data + '<br>');
            $("#prods").html(data);
        });
    });
});
$(document).ready(function () {
    // main search function
    $("#mainSearch").keyup(function () {
        const qry = $("#mainSearch").val();
        console.log('qry = ' + qry);
        $.get("filterResultsFromMainSearch.php?qry=" + qry, function (data, status) {
            console.log('data is ' + data + '<br>');
            $("#myUL").html(data);
        });
    });
    // search by categories
    $(".categories").click(function (event) {
        console.log('categories clicked');
        event.preventDefault();
        // find what element was clicked
        $target= $(event.target);
        console.log('target is ', $target);
        // check if target already has class active and remove it if yes. 
        // reset to see all products
        if($(event.target).hasClass('active')){
            console.log('it has class active')
            $target.removeClass('active');
            // reset filter to see all position
            const emtQry ='';
            $.get("fetchAllProducts.php?qry=", function (data, status) {
                document.getElementById("prods").innerHTML = data;
                // $("#prods").html(data);
            });
        }else{
        // delete all previous active classes
        $('.filter-menu a').removeClass('active');
        // add active class to clicked element
        $target.addClass('active');
        
        const qry = $(this).attr('data-catid');
        $.get("categoriesfilter.php?catid=" + qry, function (data, status) {
            $("#prods").html(data);
        });
        }
    });
    // promotion clicked
    $(".promotion").click(function () {
        $(this).addClass('d-none');
        $("#alert").removeClass('d-none').fadeOut(7000);
    })
});