function changeImg(value) {
    document.getElementById('getImg').src = value;
}

var width = 769;

$(document).ready(function() {
    $(window).on('resize', function() {
        var pageWidth = window.innerWidth;
        if (pageWidth <= width) {
            $("#btnHideSidebar").show();
        } else {
            $("#btnHideSidebar").hide();
            $("#btnShowSidebar").hide();
        }
    });
});

$(document).ready(function() {
    $(window).on('load', function() {
        var pageWidth = window.innerWidth;

        if (pageWidth <= width) {
            $("#btnSidebar").show();
        } else {
            $("#btnHideSidebar").hide();
            $("#btnShowSidebar").hide();
        }
    });
});


$(document).ready(function() {
    $("#btnShowSidebar").on('click', function() {
        $(this).hide();
        $("#btnHideSidebar").show();
        $(".sidebar").addClass("active");
    });
});

$(document).ready(function() {
    $("#btnHideSidebar").on('click', function() {
        $(this).hide();
        $("#btnShowSidebar").show();
        $(".sidebar").removeClass("active");
    });
});

// $(document).ready(function() {
//     let i = 1;

//     var quality = $("#qualityCart").text();
//     var temp = parseInt(quality);
//     $(".btn-add").on('click', function() {

//         $("#qualityCart").text(temp += i);

//     });
// });