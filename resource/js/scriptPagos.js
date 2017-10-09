   $(function() {
            $('.chosen-select').chosen();
            $('.chosen-select-deselect').chosen({
                allow_single_deselect: true

            });
        });

  $(function () {
 $("#schedule_event").change(function (evt,params) {
 if (params.selected != undefined)
    {
        check("info","",'selected: ' + params.selected);
    }
    if (params.deselected != undefined)
    {
        alert('deselected: ' + params.deselected);
    }
 });
});
