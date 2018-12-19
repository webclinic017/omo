<a class="btn default" data-toggle="modal" href="#basic" id="btnAddNewRow"> Add </a>
<!--<button type="button" class="btn blue" id="btnAddNewRow">Add</button>-->
<button type="button" class="btn default" id="btnDeleteRow">Delete</button>
<form role="form" id="formAddNewRow">
    <div class="well">
        <input type="hidden" name="id" id="id" rel="0" value="DATAROWID" />
        <div class="form-group">
            <label>Instrument</label>

            <div class="input-icon">
                <i class="fa fa-bell-o"></i>
                <!--<input type="text" class="form-control" name="instrument_code" id="instrument_code" class="required"
                       rel="0">-->
                <?php //echo $this->StockBangladesh->getInstrumentBootstrapSelect($instrumentList,'shareList'); ?>


                <select id="instrument_code" name="instrument_code" rel="1" class="bs-select form-control" data-live-search="true" title="Compare with"><optgroup label="Bank"><option value="ABBANK" >ABBANK</option><option value="ALARABANK" >ALARABANK</option><option value="BANKASIA" >BANKASIA</option><option value="BRACBANK" >BRACBANK</option><option value="CITYBANK" >CITYBANK</option><option value="DHAKABANK" >DHAKABANK</option><option value="DUTCHBANGL" >DUTCHBANGL</option><option value="EBL" >EBL</option><option value="EXIMBANK" >EXIMBANK</option><option value="FIRSTSBANK" >FIRSTSBANK</option><option value="ICBIBANK" >ICBIBANK</option><option value="IFIC" >IFIC</option><option value="ISLAMIBANK" >ISLAMIBANK</option><option value="JAMUNABANK" >JAMUNABANK</option><option value="MERCANBANK" >MERCANBANK</option><option value="MTBL" >MTBL</option><option value="NBL" >NBL</option><option value="NCCBANK" >NCCBANK</option><option value="ONEBANKLTD" >ONEBANKLTD</option><option value="PREMIERBAN" >PREMIERBAN</option><option value="PRIMEBANK" >PRIMEBANK</option><option value="PUBALIBANK" >PUBALIBANK</option><option value="RUPALIBANK" >RUPALIBANK</option><option value="SHAHJABANK" >SHAHJABANK</option><option value="SIBL" >SIBL</option><option value="SOUTHEASTB" >SOUTHEASTB</option><option value="STANDBANKL" >STANDBANKL</option><option value="TRUSTBANK" >TRUSTBANK</option><option value="UCBL" >UCBL</option><option value="UTTARABANK" >UTTARABANK</option></optgroup><optgroup label="Cement"><option value="ARAMITCEM" >ARAMITCEM</option><option value="CONFIDCEM" >CONFIDCEM</option><option value="HEIDELBCEM" >HEIDELBCEM</option><option value="LAFSURCEML" >LAFSURCEML</option><option value="MEGHNACEM" >MEGHNACEM</option><option value="MICEMENT" >MICEMENT</option><option value="PREMIERCEM" >PREMIERCEM</option></optgroup><optgroup label="Ceramics Sector"><option value="FUWANGCER" >FUWANGCER</option><option value="MONNOCERA" >MONNOCERA</option><option value="RAKCERAMIC" >RAKCERAMIC</option><option value="SPCERAMICS" >SPCERAMICS</option><option value="STANCERAM" >STANCERAM</option></optgroup><optgroup label="Corporate Bond"><option value="ACIZCBOND" >ACIZCBOND</option><option value="BRACSCBOND" >BRACSCBOND</option><option value="IBBLPBOND" >IBBLPBOND</option></optgroup><optgroup label="Debenture"><option value="DEBARACEM" >DEBARACEM</option><option value="DEBBDLUGG" >DEBBDLUGG</option><option value="DEBBDWELD" >DEBBDWELD</option><option value="DEBBDZIPP" >DEBBDZIPP</option><option value="DEBBXDENIM" >DEBBXDENIM</option><option value="DEBBXFISH" >DEBBXFISH</option><option value="DEBBXKNI" >DEBBXKNI</option><option value="DEBBXTEX" >DEBBXTEX</option></optgroup><optgroup label="Engineering"><option value="AFTABAUTO" >AFTABAUTO</option><option value="ANWARGALV" >ANWARGALV</option><option value="APOLOISPAT" >APOLOISPAT</option><option value="ATLASBANG" >ATLASBANG</option><option value="AZIZPIPES" >AZIZPIPES</option><option value="BDAUTOCA" >BDAUTOCA</option><option value="BDBUILDING" >BDBUILDING</option><option value="BDLAMPS" >BDLAMPS</option><option value="BDTHAI" >BDTHAI</option><option value="BENGALWTL" >BENGALWTL</option><option value="BSRMSTEEL" >BSRMSTEEL</option><option value="DESHBANDHU" >DESHBANDHU</option><option value="ECABLES" >ECABLES</option><option value="GOLDENSON" >GOLDENSON</option><option value="GPHISPAT" >GPHISPAT</option><option value="KAY&QUE" >KAY&QUE</option><option value="MONNOSTAF" >MONNOSTAF</option><option value="NAVANACNG" >NAVANACNG</option><option value="NPOLYMAR" >NPOLYMAR</option><option value="NTLTUBES" >NTLTUBES</option><option value="OLYMPIC" >OLYMPIC</option><option value="QSMDRYCELL" >QSMDRYCELL</option><option value="RANFOUNDRY" >RANFOUNDRY</option><option value="RENWICKJA" >RENWICKJA</option><option value="SALAMCRST" >SALAMCRST</option><option value="SINGERBD" >SINGERBD</option></optgroup><optgroup label="Financial Institutions"><option value="BAYLEASING" >BAYLEASING</option><option value="BDFINANCE" >BDFINANCE</option><option value="BIFC" >BIFC</option><option value="DBH" >DBH</option><option value="FAREASTFIN" >FAREASTFIN</option><option value="FASFIN" >FASFIN</option><option value="FLEASEINT" >FLEASEINT</option><option value="GSPFINANCE" >GSPFINANCE</option><option value="ICB" >ICB</option><option value="IDLC" >IDLC</option><option value="ILFSL" >ILFSL</option><option value="IPDC" >IPDC</option><option value="ISLAMICFIN" >ISLAMICFIN</option><option value="LANKABAFIN" >LANKABAFIN</option><option value="MIDASFIN" >MIDASFIN</option><option value="NHFIL" >NHFIL</option><option value="PHOENIXFIN" >PHOENIXFIN</option><option value="PLFSL" >PLFSL</option><option value="PREMIERLEA" >PREMIERLEA</option><option value="PRIMEFIN" >PRIMEFIN</option><option value="ULC" >ULC</option><option value="UNIONCAP" >UNIONCAP</option><option value="UTTARAFIN" >UTTARAFIN</option></optgroup><optgroup label="Food & Allied"><option value="AMCL(PRAN)" >AMCL(PRAN)</option><option value="APEXFOODS" >APEXFOODS</option><option value="BANGAS" >BANGAS</option><option value="BATBC" >BATBC</option><option value="BEACHHATCH" >BEACHHATCH</option><option value="CVOPRL" >CVOPRL</option><option value="FINEFOODS" >FINEFOODS</option><option value="FUWANGFOOD" >FUWANGFOOD</option><option value="GEMINISEA" >GEMINISEA</option><option value="GHAIL" >GHAIL</option><option value="MEGCONMILK" >MEGCONMILK</option><option value="MEGHNAPET" >MEGHNAPET</option><option value="NTC" >NTC</option><option value="RAHIMAFOOD" >RAHIMAFOOD</option><option value="RDFOOD" >RDFOOD</option><option value="SHYAMPSUG" >SHYAMPSUG</option><option value="ZEALBANGLA" >ZEALBANGLA</option></optgroup><optgroup label="Fuel & Power"><option value="BDWELDING" >BDWELDING</option><option value="BEDL" >BEDL</option><option value="DESCO" >DESCO</option><option value="EASTRNLUB" >EASTRNLUB</option><option value="GBBPOWER" >GBBPOWER</option><option value="JAMUNAOIL" >JAMUNAOIL</option><option value="KPCL" >KPCL</option><option value="LINDEBD" >LINDEBD</option><option value="MJLBD" >MJLBD</option><option value="MPETROLEUM" >MPETROLEUM</option><option value="PADMAOIL" >PADMAOIL</option><option value="POWERGRID" >POWERGRID</option><option value="SPPCL" >SPPCL</option><option value="SUMITPOWER" >SUMITPOWER</option><option value="TITASGAS" >TITASGAS</option></optgroup><optgroup label="Insurance"><option value="AGRANINS" >AGRANINS</option><option value="ASIAINS" >ASIAINS</option><option value="ASIAPACINS" >ASIAPACINS</option><option value="BGIC" >BGIC</option><option value="CENTRALINS" >CENTRALINS</option><option value="CITYGENINS" >CITYGENINS</option><option value="CONTININS" >CONTININS</option><option value="DELTALIFE" >DELTALIFE</option><option value="DHAKAINS" >DHAKAINS</option><option value="EASTERNINS" >EASTERNINS</option><option value="EASTLAND" >EASTLAND</option><option value="FAREASTLIF" >FAREASTLIF</option><option value="FEDERALINS" >FEDERALINS</option><option value="GLOBALINS" >GLOBALINS</option><option value="GREENDELT" >GREENDELT</option><option value="ISLAMIINS" >ISLAMIINS</option><option value="JANATAINS" >JANATAINS</option><option value="KARNAPHULI" >KARNAPHULI</option><option value="MEGHNALIFE" >MEGHNALIFE</option><option value="MERCINS" >MERCINS</option><option value="NATLIFEINS" >NATLIFEINS</option><option value="NITOLINS" >NITOLINS</option><option value="NORTHRNINS" >NORTHRNINS</option><option value="PADMALIFE" >PADMALIFE</option><option value="PARAMOUNT" >PARAMOUNT</option><option value="PEOPLESINS" >PEOPLESINS</option><option value="PHENIXINS" >PHENIXINS</option><option value="PIONEERINS" >PIONEERINS</option><option value="POPULARLIF" >POPULARLIF</option><option value="PRAGATIINS" >PRAGATIINS</option><option value="PRAGATILIF" >PRAGATILIF</option><option value="PRIMEINSUR" >PRIMEINSUR</option><option value="PRIMELIFE" >PRIMELIFE</option><option value="PROGRESLIF" >PROGRESLIF</option><option value="PROVATIINS" >PROVATIINS</option><option value="PURABIGEN" >PURABIGEN</option><option value="RELIANCINS" >RELIANCINS</option><option value="REPUBLIC" >REPUBLIC</option><option value="RUPALIINS" >RUPALIINS</option><option value="RUPALILIFE" >RUPALILIFE</option><option value="SANDHANINS" >SANDHANINS</option><option value="SONARBAINS" >SONARBAINS</option><option value="STANDARINS" >STANDARINS</option><option value="SUNLIFEINS" >SUNLIFEINS</option><option value="TAKAFULINS" >TAKAFULINS</option><option value="UNITEDINS" >UNITEDINS</option></optgroup><optgroup label="IT Sector"><option value="AAMRATECH" >AAMRATECH</option><option value="AGNISYSL" >AGNISYSL</option><option value="BDCOM" >BDCOM</option><option value="DAFODILCOM" >DAFODILCOM</option><option value="INTECH" >INTECH</option><option value="ISNLTD" >ISNLTD</option></optgroup><optgroup label="Jute"><option value="JUTESPINN" >JUTESPINN</option><option value="NORTHERN" >NORTHERN</option><option value="SONALIANSH" >SONALIANSH</option></optgroup><optgroup label="Miscellaneous"><option value="ARAMIT" >ARAMIT</option><option value="BERGERPBL" >BERGERPBL</option><option value="BEXIMCO" >BEXIMCO</option><option value="BSC" >BSC</option><option value="GQBALLPEN" >GQBALLPEN</option><option value="MIRACLEIND" >MIRACLEIND</option><option value="SAVAREFR" >SAVAREFR</option><option value="SINOBANGLA" >SINOBANGLA</option><option value="USMANIAGL" >USMANIAGL</option></optgroup><optgroup label="Mutual Funds"><option value="1JANATAMF" >1JANATAMF</option><option value="1STICB" >1STICB</option><option value="1STPRIMFMF" >1STPRIMFMF</option><option value="2NDICB" >2NDICB</option><option value="3RDICB" >3RDICB</option><option value="4THICB" >4THICB</option><option value="5THICB" >5THICB</option><option value="6THICB" >6THICB</option><option value="7THICB" >7THICB</option><option value="8THICB" >8THICB</option><option value="ABB1STMF" >ABB1STMF</option><option value="AIBL1STIMF" >AIBL1STIMF</option><option value="AIMS1STMF" >AIMS1STMF</option><option value="DBH1STMF" >DBH1STMF</option><option value="EBL1STMF" >EBL1STMF</option><option value="EBLNRBMF" >EBLNRBMF</option><option value="EXIM1STMF" >EXIM1STMF</option><option value="FBFIF" >FBFIF</option><option value="GRAMEEN1" >GRAMEEN1</option><option value="GRAMEENS2" >GRAMEENS2</option><option value="GREENDELMF" >GREENDELMF</option><option value="ICB1STNRB" >ICB1STNRB</option><option value="ICB2NDNRB" >ICB2NDNRB</option><option value="ICB3RDNRB" >ICB3RDNRB</option><option value="ICBAMCL2ND" >ICBAMCL2ND</option><option value="ICBEPMF1S1" >ICBEPMF1S1</option><option value="ICBISLAMIC" >ICBISLAMIC</option><option value="ICBSONALI1" >ICBSONALI1</option><option value="IFIC1STMF" >IFIC1STMF</option><option value="IFILISLMF1" >IFILISLMF1</option><option value="LRGLOBMF1" >LRGLOBMF1</option><option value="MBL1STMF" >MBL1STMF</option><option value="NCCBLMF1" >NCCBLMF1</option><option value="NLI1STMF" >NLI1STMF</option><option value="PF1STMF" >PF1STMF</option><option value="PHPMF1" >PHPMF1</option><option value="POPULAR1MF" >POPULAR1MF</option><option value="PRIME1ICBA" >PRIME1ICBA</option><option value="RELIANCE1" >RELIANCE1</option><option value="SEBL1STMF" >SEBL1STMF</option><option value="TRUSTB1MF" >TRUSTB1MF</option></optgroup><optgroup label="Paper & Printing"><option value="HAKKANIPUL" >HAKKANIPUL</option></optgroup><optgroup label="Pharmaceuticals & Chemicals"><option value="ACI" >ACI</option><option value="ACIFORMULA" >ACIFORMULA</option><option value="ACTIVEFINE" >ACTIVEFINE</option><option value="AMBEEPHA" >AMBEEPHA</option><option value="BEACONPHAR" >BEACONPHAR</option><option value="BXPHARMA" >BXPHARMA</option><option value="BXSYNTH" >BXSYNTH</option><option value="CENTRALPHL" >CENTRALPHL</option><option value="GHCL" >GHCL</option><option value="GLAXOSMITH" >GLAXOSMITH</option><option value="IBNSINA" >IBNSINA</option><option value="IMAMBUTTON" >IMAMBUTTON</option><option value="JMISMDL" >JMISMDL</option><option value="KEYACOSMET" >KEYACOSMET</option><option value="KOHINOOR" >KOHINOOR</option><option value="LIBRAINFU" >LIBRAINFU</option><option value="MARICO" >MARICO</option><option value="ORIONINFU" >ORIONINFU</option><option value="ORIONPHARM" >ORIONPHARM</option><option value="PHARMAID" >PHARMAID</option><option value="RECKITTBEN" >RECKITTBEN</option><option value="RENATA" >RENATA</option><option value="SALVOCHEM" >SALVOCHEM</option><option value="SQURPHARMA" >SQURPHARMA</option></optgroup><optgroup label="Services & Real Estate"><option value="EHL" >EHL</option><option value="SAMORITA" >SAMORITA</option><option value="SAPORTL" >SAPORTL</option></optgroup><optgroup label="Tannery Industries"><option value="APEXADELFT" >APEXADELFT</option><option value="APEXTANRY" >APEXTANRY</option><option value="BATASHOE" >BATASHOE</option><option value="LEGACYFOOT" >LEGACYFOOT</option><option value="SAMATALETH" >SAMATALETH</option></optgroup><optgroup label="Telecommunication"><option value="BSCCL" >BSCCL</option><option value="GP" >GP</option></optgroup><optgroup label="Textile"><option value="AL-HAJTEX" >AL-HAJTEX</option><option value="ALLTEX" >ALLTEX</option><option value="ANLIMAYARN" >ANLIMAYARN</option><option value="APEXSPINN" >APEXSPINN</option><option value="ARGONDENIM" >ARGONDENIM</option><option value="CMCKAMAL" >CMCKAMAL</option><option value="DACCADYE" >DACCADYE</option><option value="DELTASPINN" >DELTASPINN</option><option value="DSHGARME" >DSHGARME</option><option value="DULAMIACOT" >DULAMIACOT</option><option value="ENVOYTEX" >ENVOYTEX</option><option value="FAMILYTEX" >FAMILYTEX</option><option value="GENNEXT" >GENNEXT</option><option value="HRTEX" >HRTEX</option><option value="MAKSONSPIN" >MAKSONSPIN</option><option value="MALEKSPIN" >MALEKSPIN</option><option value="METROSPIN" >METROSPIN</option><option value="MITHUNKNIT" >MITHUNKNIT</option><option value="MODERNDYE" >MODERNDYE</option><option value="PRIMETEX" >PRIMETEX</option><option value="PTL" >PTL</option><option value="RAHIMTEXT" >RAHIMTEXT</option><option value="RNSPIN" >RNSPIN</option><option value="SAFKOSPINN" >SAFKOSPINN</option><option value="SAIHAMCOT" >SAIHAMCOT</option><option value="SAIHAMTEX" >SAIHAMTEX</option><option value="SONARGAON" >SONARGAON</option><option value="SQUARETEXT" >SQUARETEXT</option><option value="STYLECRAFT" >STYLECRAFT</option><option value="TALLUSPIN" >TALLUSPIN</option><option value="ZAHINTEX" >ZAHINTEX</option></optgroup><optgroup label="Travel & Leisure"><option value="BDSERVICE" >BDSERVICE</option><option value="UNIQUEHRL" >UNIQUEHRL</option><option value="UNITEDAIR" >UNITEDAIR</option></optgroup></select>


            </div>
        </div>
        <div class="form-group">
            <label>meta_key</label>

            <div class="input-icon">
                <i class="fa fa-bell-o"></i>
                <select id="meta_key" name="meta_key" rel="2" class="bs-select form-control" data-live-search="true" title="Compare with">
                    <?php foreach($fundamentalMetas as $keyid=>$meta){?>
                    <option value="<?php echo $keyid;?>" ><?php echo $meta;?></option>
                    <?php }?>
                </select>
                <!--<input type="text" class="form-control" name="meta_key" id="meta_key" class="required" rel="1">-->

            </div>
        </div>
        <div class="form-group">
            <label>meta_value</label>

            <div class="input-icon">
                <i class="fa fa-bell-o"></i>
                <input type="text" class="form-control" name="meta_value" id="meta_value" class="required" rel="3">
            </div>
        </div>
        <div class="form-group">
            <label>meta_date</label>

            <div class="input-icon">
                <i class="fa fa-bell-o"></i>
                <!--<input type="text" class="form-control" name="meta_date" id="meta_date" class="required" rel="3">-->
                <input  name="meta_date" id="meta_date" rel="4" class="form-control form-control-inline input-medium date-picker" size="16" type="text" value=""/>
            </div>
        </div>
        <span class="datafield" rel="5" style="display:none"><a class="table-action-deletelink" href="DeleteData.php?test=test&id=DATAROWID">Edit</a></span>

        <div class="form-actions">
            <button type="submit" id="btnAddNewRowOk" class="btn blue">Submit</button>
            <button type="button" id="btnAddNewRowCancel" class="btn default">Cancel</button>
        </div>
    </div>

</form>


<table class="table table-striped table-hover table-bordered" id="users-table">
    <thead>
    <th>ID</th>
    <th>instrument_code</th>
    <th>meta_key</th>
    <th>meta_value</th>
    <th>meta_date</th>
    <th></th>

    </thead>
    <tbody>
    </tbody>
</table>
<?php $this->start('script_inside_doc_ready'); ?>
ComponentsPickers.init();
$('#users-table').dataTable({
//"iDisplayLength": 10,
"bProcessing": true,
"bServerSide": true,
"sAjaxSource": "<?php echo Router::url(array('controller'=>'Fundamentals','action'=>'index.json'));?>",
"sDom": 'CRTfrtip',
"aoColumns": [
/*{mData:"Fundamental.id",bVisible: false},
{mData:"Instrument.instrument_code"},
{mData:"FundamentalMeta.meta_key",bSearchable:false},
{mData:"Fundamental.meta_value",bSearchable:true},
{mData:"Fundamental.meta_date",bSearchable:false},
{bSortable: false, bSearchable: false},
        */

{bVisible: false},
null,
null,
null,
null,
{bSortable: false, bSearchable: false},
],
"fnCreatedRow": function(nRow, aData, iDataIndex){
//$('td:eq(4)', nRow).html('<button onclick="alert(\'City.id is '+aData[0]+'\')">Button</button>');
$('td:eq(4)', nRow).html('<a class="table-action-deletelink" href="<?php echo Router::url(array('controller'=>'Fundamentals','action'=>'delete'));?>/'+aData[0]+'">Delete</a>');
}

});

$('#users-table').dataTable().makeEditable({
sReadOnlyCellClass: "read_only",
sUpdateURL: "/Home/UpdateData.php",
sDeleteURL: "<?php echo Router::url(array('controller'=>'Fundamentals','action'=>'delete'));?>",
sAddURL: "<?php echo Router::url(array('controller'=>'Fundamentals','action'=>'add'));?>"
});
$('#users-table').on('click', 'tbody tr', function(event) {
$(this).addClass('success').siblings().removeClass('success');
});
<?php $this->end(); ?>
