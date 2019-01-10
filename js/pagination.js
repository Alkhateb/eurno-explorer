var $table = document.getElementById("producerTable"),
$w = window.innerWidth,
$cont = document.getElementById("prodCont"),
$n = 21,
$rowCount = $table.rows.length,
$firstRow = $table.rows[0].firstElementChild.tagName,
$hasHead = ($firstRow === "TH"),
$tr = [],
$i,$ii,$j = ($hasHead)?1:0;
$th = ($hasHead?$table.rows[(0)].outerHTML:"");
var $pageCount = Math.ceil($rowCount / $n);
if ($pageCount > 1) {
    for ($i = $j,$ii = 0; $i < $rowCount; $i++, $ii++)
        $tr[$ii] = $table.rows[$i].outerHTML;
    $cont.insertAdjacentHTML("afterend","<div id='buttons'></div");
    sort(1);
}
function sort($p) {
    var $rows = $th,$s = (($n * $p)-$n);
    for ($i = $s; $i < ($s+$n) && $i < $tr.length; $i++)
        $rows += $tr[$i];
    $table.innerHTML = $rows;
    document.getElementById("buttons").innerHTML = pageButtons($pageCount,$p);
    document.getElementById("id"+$p).setAttribute("class","active btn btn-secondary");
}
function pageButtons($pCount,$cur) {
    var $prevDis = ($cur == 1)?"disabled":"",
        $nextDis = ($cur == $pCount)?"disabled":"",
        $buttons ='<div class="row w-100 mx-auto my-4">';
        $buttons += '<div class="btn-group mx-auto" role="group">';
        $buttons += "<button type='button' value='&lt;&lt; Prev' class='btn btn-secondary'  onclick='sort("+($cur - 1)+")' "+$prevDis+">&lt;&lt; Prev</button>";
        if($w > 500){
    for ($i=1; $i<=$pCount;$i++)
        $buttons += "<button type='button' id='id"+$i+"'value='"+$i+"' class='btn btn-secondary'  onclick='sort("+$i+")'>"+$i+"</button>";
      }
        $buttons += "<button type='button' value='Next &gt;&gt;' class='btn btn-secondary' onclick='sort("+($cur + 1)+")' "+$nextDis+">Next &gt;&gt;</button>";
        $buttons += '</div>';
        $buttons += '</div>';
    return $buttons;
}
