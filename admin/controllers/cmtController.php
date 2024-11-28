<?php
class cmtController
{
    public $cmtModel;
    function __construct()
    {
        $this->cmtModel = new cmtModel();
    }
    function binhluan()
    {
        $listComment=$this->cmtModel->getComment();
        //mnhom binh luan theo san pham
        $commentsByProduct=[];
        foreach ($listComment as $comment){
            $idpro=$comment['idpro'];
            $commentsByProduct[$idpro]['tensp']=$comment['tensp'];
            $commentsByProduct[$idpro]['binh_luan'][]=[
                'idbl'=>$comment['idbl'],
                'noidung'=>$comment['noidung'],
                'ngaybinhluan'=>$comment['ngaybinhluan'],
                'rating'=>$comment['rating'],
                'user'=>$comment['user'],
              
             
            ];
        }
        require_once 'views/binhluan.php';
    }
    function deleteBl(){
      
            if ($_GET['id']) {
                $id = $_GET['id'];
                $idbl = $this->cmtModel->deleteBl($id);
            }
            header('location:index.php?act=binhluan');
        
    }
}
