$(document).ready(function () {
    $('#myTable').DataTable({
        paging:true,
        language: {
            url: "//cdn.datatables.net/plug-ins/2.0.0/i18n/fr-FR.json" // Replace with the actual path to your plugin JSON file
        },
    });
});