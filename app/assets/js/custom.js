$(document).ready(function() {
    //on click modal buton
    $(".editJudul").on("click", function() {
        var judul = $(this).closest("tr").find('td:nth-child(1)').text().trim();
        var id = $(this).closest("tr").find('td:nth-child(2)').text().trim();
        $('#judul').val(judul); //set value
        $('#id').val(id); //set value
    })
});

// $(document).ready(function() {
//     //on click modal buton
//     $(".publishJudul").on("click", function() {
//         var publishjudul = $(this).
//         $('#publishjudul').val(publishjudul); //set value
//         $('#publishid').val(publishid); //set value
//     })
// });