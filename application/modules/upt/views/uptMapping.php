<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="block block-drop-shadow">
                <div class="header">
                    <h2>SEBARAN UPT REPUBLIK INDONESIA</h2>
                </div>
                <div class="content np">
                    <div id="mapid" style="height: 840px">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="detail">
    <div class="modal-dialog" role="document" style="width:700px;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="titleModal">DETAIL UPT</h4>
            </div>
            <div class="modal-body clearfix">
                <div class="scroll">
                    <br>
                    <table id="detailUPT" class="table table-striped table-hover" style="width: 100%">
                        <thead>
                        <tr>
                            <th id="titleTable">Satuan Pengawasan (SATWAS)</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <center>
                    <button class="btn btn-success btn-lg" id="btnShowMapping" data-dismiss="modal">LIHAT MAPPING SATWAS</button>
                </center>
                <br>
            </div>
        </div>
    </div>
</div>

<script>

    var mymap = "";
    var map = "";

    mymap = L.map('mapid').setView([-2.546, 118.016], 5);

    var greenIcon = new L.Icon({
        iconUrl: '<?php echo asset('marker/marker-icon-2x-green.png');?>',
        shadowUrl: '<?php echo asset('marker/marker-shadow.png');?>',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });

    var orangeIcon = new L.Icon({
        iconUrl: '<?php echo asset('marker/marker-icon-2x-orange.png');?>',
        shadowUrl: '<?php echo asset('marker/marker-shadow.png');?>',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });

    var blueIcon = new L.Icon({
        iconUrl: '<?php echo asset('marker/marker-icon-2x-blue.png');?>',
        shadowUrl: '<?php echo asset('marker/marker-shadow.png');?>',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: 'PSDKP ISBData',
        id: 'mapbox.streets',
        zoomControl: false
    }).addTo(mymap);

    <?php  foreach ($upt->data->content as $p){ ?>

    
    L.marker([<?php echo $p->langitude ?>,<?php echo $p->longitude; ?>], {icon: greenIcon}).addTo(mymap).bindPopup(
        "<div class='col-md-12'>" +
        "<div class='pull-right'><i><b><?php echo $p->code; ?></b></i></div>" +
        "<br> " +
        "<b id='nameUnit'><?php echo $p->name; ?></b>" +
        "<br>" +
        '<i class="fa fa-location-arrow" ></i>&nbsp' +
        "<t id='faximail'><i><?php echo $p->langitude; ?>, <?php echo $p->longitude; ?> </i></t><hr/>" +
        '<i class="fa fa-home" ></i>&nbsp' +
        "<t style='text-align: justify;'><?php echo $p->address; ?> </t>." +
        "<br> " +
        '<i class="fa fa-phone-square" ></i>&nbsp' +
        "<t id='phone'><i><?php echo $p->phone; ?></i></t>" +
        "<br> " +
        '<i class="fa fa-fax"></i>&nbsp' +
        "<t id='faximail'><i><?php echo $p->faxmail; ?></i></t>" +
        "<br> " +
        '<i class="fa fa-envelope"></i>&nbsp' +
        "<t id='email'><i><?php echo $p->email; ?></i></t><hr/>" +
        "<b>Lokasi Pelayanan : </b>&nbsp<?php echo $p->serviceLocation; ?><hr/>" +
        "<b>Fasilitas Sarana dan Prasarana: </b> </div>" +
        "<div class='col-md-6'>"+
        <?php if (!empty($p->facilities)) { foreach ($p->facilities as $f) {?>
            "+ <?php echo $f->name; ?><br/>"+
        <?php } } else { ?>
            "-"+
        <?php } ?>
        "</div>"+
        "<div class='col-md-6'>"+
        <?php if (!empty($p->infrastructures)) { foreach ($p->infrastructures as $i) {?>
            "+ <?php echo $i->name; ?><br/>"+
        <?php } } else { ?>
            "-"+
        <?php } ?>
        "</div>"+
        "<br><br>" +
        "<br><br>" +
        "<div class='col-md-12'>"+
        <?php if ($p->typeUnit->type != "WILKER") {
            if ($p->typeUnit->type == "UPT") { ?>
            "<a href='#' class='pull-right' onclick='showModal(<?php echo $p->id; ?>,\"<?php echo $p->typeUnit->type; ?>\")'><b>Lihat Satwas</b></a> " + <?php 
            } else if ($p->typeUnit->type == "SATWAS") { ?>
            "<a href='#' class='pull-right' onclick='showModal(<?php echo $p->id; ?>,\"<?php echo $p->typeUnit->type; ?>\")'><b>Lihat Wilker</b></a> " + <?php 
            } else {

            }
        } ?>
        "<br></div>");
    <?php } ?>

    mymap.dragging.disable();
    mymap.scrollWheelZoom.disable();

    function getDetail(id) {
        $.ajax({
            type: "GET",
            url: "/upt/mapping/getMappingByParrent/" + id,
            dataType: "json",
            success: function (data) {
                console.log(data);
            }
        });
    }

    function showModal(id, type) {
        $.ajax({
            type: "GET",
            url: "/upt/mapping/getMappingByParrent/" + id,
            dataType: "json",
            success: function (data) {
                if (data.data.totalElements==0){
                    $("#btnShowMapping").attr('disabled', 'disabled');
                } else {
                    $("#btnShowMapping").removeAttr('disabled');
                }
            }
        });
        if (type=="UPT"){
            $("#titleTable").html("Satuan Pengawasan (SATWAS)");
            $("#titleModal").html("DETAIL SATWAS");
            $("#btnShowMapping").html("LIHAT MAPPING  SATWAS");
        } else if (type=="SATWAS"){
            $("#titleTable").html("Wilayah Kerja (WILKER)");
            $("#titleModal").html("DETAIL WILKER");
            $("#btnShowMapping").html("LIHAT MAPPING  WILKER");
        }
        getDetailChild(id, type);
        $("#detail").modal("show");
    }

    function getDetailChild(id, type) {
        var table = $('#detailUPT').DataTable({
            ajax: {
                url: '<?php echo base_url()?>/upt/mapping/getMappingByParrent/' + id,
                dataSrc: 'data.content',
                processing: true
            },
            columns: [
                {
                    data: "",
                    render: function (data, type, full) {
                        return full.child.name.toUpperCase();
                    }
                }
            ],
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            "bDestroy": true
        });
        $("#btnShowMapping").attr("onclick","renderDetailChild("+id+",'"+type+"')");

    }

    function renderDetailChild(id, type){
        console.log(id);

        if (type=="UPT") {
            $.ajax({
                type: "GET",
                url: "/upt/mapping/getMappingByParrent/" + id,
                dataType: "json",
                success: function (data) {
                    console.log(data.data.content);
                    mymap.remove();

                    map = L.map('mapid').setView([-2.546, 118.016], 5);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 18,
                        attribution: 'PSDKP ISBData',
                        id: 'mapbox.streets',
                        zoomControl: false
                    }).addTo(map);

                    $.each(data.data.content, function (index, data) {
                        var typeData = "";
                        if (data.child.typeUnit.type == "UPT") {
                            typeData = "Satwas";
                        } else {
                            typeData = "Wilker"
                        }
                        L.marker([data.child.langitude, data.child.longitude], {icon: orangeIcon}).addTo(map).bindPopup("" +
                            "<b id='nameUnit'>" + data.child.name + "</b>" +
                            "<br>" +
                            "<t id='typeUnit'>" + data.child.typeUnit.type + "</t><hr />" +
                            "<t style='text-align: justify;'>" + data.child.address + "</t>" +
                            "<t id='phone'><i>" + data.child.phone + "</i></t>, " +
                            "<t id='faximail'><i>" + data.child.faxmail + "</i></t>" +
                            "<br><br>" +
                            "<b>Pelayanan : </b>" + data.child.serviceLocation +
                            "<br>" +
                            "<br>" +
                            "<a href='#' class='pull-right' onclick='showModal(" + data.child.id + ",\"" + data.child.typeUnit.type + "\")'><b>Lihat " + typeData + "</b></a> " +
                            "<br>");
                    });

                    map.dragging.disable();
                    map.scrollWheelZoom.disable();
                }
            });
        } else {
            $.ajax({
                type: "GET",
                url: "/upt/mapping/getMappingByParrent/" + id,
                dataType: "json",
                success: function (data) {
                    console.log(data.data.content);
                    map.remove();

                    maymap = L.map('mapid').setView([-2.546, 118.016], 5);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 18,
                        attribution: 'PSDKP ISBData',
                        id: 'mapbox.streets',
                        zoomControl: false
                    }).addTo(maymap);

                    $.each(data.data.content, function (index, data) {
                        var typeData = "";
                        if (data.child.typeUnit.type == "UPT") {
                            typeData = "Satwas";
                        } else {
                            typeData = "Wilker"
                        }
                        L.marker([data.child.langitude, data.child.longitude], {icon: blueIcon}).addTo(maymap).bindPopup("" +
                            "<b id='nameUnit'>" + data.child.name + "</b>" +
                            "<br>" +
                            "<t id='typeUnit'>" + data.child.typeUnit.type + "</t><hr />" +
                            "<t style='text-align: justify;'>" + data.child.address + "</t>" +
                            "<t id='phone'><i>" + data.child.phone + "</i></t>, " +
                            "<t id='faximail'><i>" + data.child.faxmail + "</i></t>" +
                            "<br><br>" +
                            "<b>Pelayanan : </b>" + data.child.serviceLocation +
                            "<br>" +
                            "<br>" +
                            "<a href='#' class='pull-right' onclick='showModal(" + data.child.id + ",\"" + data.child.typeUnit.type + "\")'><b>Lihat " + typeData + "</b></a> " +
                            "<br>");
                    });

                    maymap.dragging.disable();
                    maymap.scrollWheelZoom.disable();
                }
            });
        }
        
    }

</script>