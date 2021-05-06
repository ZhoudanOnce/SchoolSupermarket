<?php
class PageWeb {
    public $firstRow	;
    public $listRows	;
    public $parameter  ;
    protected $totalPages  ;
    protected $totalRows  ;
    protected $nowPage    ;
    protected $coolPages   ;
    protected $rollPage   ;
	protected $config  =	array('header'=>'条记录','prev'=>'上一页','next'=>'下一页','first'=>'第一页','last'=>'最后一页','theme'=>'<ul class="pagination">     %upPage% %linkPage%  %downPage%</ul>');
	
    public function __construct($totalRows,$listRows,$parameter='',$page) {
        $this->totalRows = $totalRows;
        $this->parameter = $parameter;
        $this->rollPage = 5;
        $this->listRows = !empty($listRows)?$listRows:5;
        $this->totalPages = ceil($this->totalRows/$this->listRows);     //总页数
        $this->coolPages  = ceil($this->totalPages/$this->rollPage);
        $this->nowPage  = !empty($page)?$page:1;
        if(!empty($this->totalPages) && $this->nowPage>$this->totalPages) {
            $this->nowPage = $this->totalPages;
        }
        $this->firstRow = $this->listRows*($this->nowPage-1);
    }

    public function setConfig($name,$value) {
        if(isset($this->config[$name])) {
            $this->config[$name]    =   $value;
        }
    }

    public function show() {
        if(0 == $this->totalRows) return '';
        $p = "page";
        $nowCoolPage      = ceil($this->nowPage/$this->rollPage);
        $url  =  $_SERVER['REQUEST_URI'].(strpos($_SERVER['REQUEST_URI'],'?')?'':"?").$this->parameter;
        $parse = parse_url($url);
        if(isset($parse['query'])) {
            parse_str($parse['query'],$params);
            unset($params[$p]);
            $url   =  $parse['path'].'?'.http_build_query($params);
        }
        $upRow   = $this->nowPage-1;
        $downRow = $this->nowPage+1;
        if ($upRow>0){
            $upPage="<li><a class='paginate_button' href='".$url."&".$p."=$upRow'>&lt;&lt;</a></li>";
        }else{
            $upPage="";
        }

        if ($downRow <= $this->totalPages){
            $downPage="<li><a class='paginate_button' href='".$url."&".$p."=$downRow'>&gt;&gt;</a></li>";
        }else{
            $downPage="";
        }
        // << < > >>
        if($nowCoolPage == 1){
            $theFirst = "";
            $prePage = "";
        }else{
            $preRow =  $this->nowPage-$this->rollPage;
            $prePage = "<li><a class='paginate_button' href='".$url."&".$p."=$preRow' >上".$this->rollPage."页</a>";
            $theFirst = "<a class='paginate_button' href='".$url."&".$p."=1' >".首页."</a>";
        }
        if($nowCoolPage == $this->coolPages){
            $nextPage = "";
            $theEnd="";
        }else{
            $nextRow = $this->nowPage+$this->rollPage;
            $theEndRow = $this->totalPages;
            $nextPage = "<a class='paginate_button' href='".$url."&".$p."=$nextRow' >下".$this->rollPage."页</a>";
            $theEnd = "<a class='paginate_button' href='".$url."&".$p."=$theEndRow' >".尾页."</a>";
        }
        $linkPage = "";
        for($i=1;$i<=$this->rollPage;$i++){
            $page=($nowCoolPage-1)*$this->rollPage+$i;
            if($page!=$this->nowPage){
                if($page<=$this->totalPages){
                    $linkPage .= "&nbsp;<li><a class='paginate_button' href='".$url."&".$p."=$page'>".$page."</a></li>";
                }else{
                    break;
                }
            }else{
                if($this->totalPages != 1){
                    $linkPage .= "&nbsp;<li class='active'><span class='paginate_button'>".$page."</span></li>";

                }
            }
        }
        $pageStr	 =	 str_replace(
            array('%header%','%nowPage%','%totalRow%','%totalPage%','%upPage%','%downPage%','%first%','%prePage%','%linkPage%','%nextPage%','%end%'),
            array($this->config['header'],$this->nowPage,$this->totalRows,$this->totalPages,$upPage,$downPage,$theFirst,$prePage,$linkPage,$nextPage,$theEnd),$this->config['theme']);
        return $pageStr;
    }

}
?>