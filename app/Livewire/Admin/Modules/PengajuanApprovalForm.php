<?php

namespace App\Livewire\Admin\Modules;

use App\Libs\livewire;
use Livewire\Component;
use App\Models\Attachment;
use Illuminate\Support\Str;
use Livewire\Attributes\Url;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class PengajuanApprovalForm extends Component
{
    use WithFileUploads;
    #[Url] 
    public $id, $page,$perpage = 10,$q,$orderby,$ordermethod;
    public $title,$orlansoft,$transactiontype_id,$requesttype_id=2,$trno,$remarks,$response;
    public $orlansoftOptions,$transactiontypeOptions,$transactionData;
    public $searchReturn,$searchQuery,$searchShow;
    public $newAttachmentField = false,$attachments,$notes;
    // #[Validate('mimes:jpg,jpeg,png,xls,xlsx,pdf,doc,docx|max:2048')]
    public $newattachment;
    public $doSearch = false, $errorPopup,$errorsInput,$successPopup;
    public $returnData,$responseData,$uploadData;
    public $requestor,$userData,$responser;
    public $isRequestor,$isResponser;
    public $urltoshare;
    


    public $a_way_to_face_bug = null;
    
    public $data = [
        'title' => 'Form Pengajuan Approval'
    ];
    
    public function rules() {
        return [
            'title' => 'required',
            'orlansoft' => 'required',
            'transactiontype_id' => 'required',
            'requesttype_id' => 'required',
            'trno' => 'required',
            'remarks' => 'required',
        ];
    }

    function newAttachment($save = 0) {
        
       
        
        if (@$this->id == null) {
            # code...
            $this->save(3);
        }
        else{
            if (!$this->validate()) {
                return; // Stop execution if validation fails
            }
        }

        if (@$this->id == null) return;
        $this->newAttachmentField = true;
        if ($save === 1) {
            
            $this->attachmentSave();
        }
        
        

    }
    function mount() {
        
        $this->errorsInput = null;
        $this->dispatch('GlobalData',$this->data);
        $this->initRequest();
        $this->initOrlansoft() ;
        $this->initTransactionType();       
        $this->initAttachment();   
        $this->initTransaction();
        // $this->user = json_decode($_COOKIE['user']);

        
        
    }

    public function setpage($page){
        $this->page = $page;
        $this->initTransaction();
    }

    public function initTransaction()
    {
        if ($this->trno != null) {
            if($this->page ?? null !== null) $input['page'] = $this->page;
            if($this->perpage ?? null !== null) $input['perpage'] = $this->perpage;
            if($this->q ?? null !== null) $input['q'] = $this->q;
            if($this->orderby ?? null !== null) $input['orderby'] = $this->orderby;
            if($this->ordermethod ?? null !== null) $input['ordermethod'] = $this->ordermethod;
            $this->transactionData = @(
                (
                    livewire::getHTTP(
                        config('web.APIHost')
                        .'api/request/'
                        .@$this->orlansoft
                        .'/orlansofttransactiondetail/'
                        .@$this->transactiontype_id
                        .'/'
                        .@$this->trno,
                        $input ?? []
                    )
                )
            )['data'];

            // dump($this->transactionData);
            
        }
    }
    public function setTrno($trno) {
        $this->trno = $trno;
        $this->stopSearch();
        $this->initTransaction();
        
        
    }
    public function save($responseStatus = null) {
        
        // $responseStatus = array_map('intval', $responseStatus);
        
        $this->errorsInput = null;
        if (!$this->validate()) {
                return; // Stop execution if validation fails
            }
            
            
            if (@$this->orlansoft == null) {
                $this->errorPopup = "Anda belum memilih Orlansoft !";
                $this->errorsInput['orlansoft'][] ="Required";
                return;
            }
            $input = [
                'title' => $this->title,
                'transactiontype_id' => $this->transactiontype_id,
                'requesttype_id' => $this->requesttype_id,
                'trno' => $this->trno,
                'remarks' => $this->remarks
            ];
            
            #route

            
            

            if ($this->id != null) {

                if ($this->isRequestor !== true) {
                    goto updateResponse;
                }

                // UPDATING
                $apiURL = 'api/request/'.$this->orlansoft.'/update/'.$this->id;
                $this->returnData = $body = livewire::postHTTP($apiURL , $input);
                if (@$body['errorsInput'] != null) {
                    $this->errorsInput = $body['errorsInput'];
                }
                if (@$body['success'] != true) {
                    $this->errorPopup = 'Failed ! '.@$body['message'];
                    return;
                }

                goto updateResponse;
            }
            
            
            // REGISTERING
            $apiURL = config('web.APIHost')
            .'api/request/'.$this->orlansoft.'/register';
            $this->returnData = $body = livewire::postHTTP($apiURL , $input);
            if (@$body['errorsInput'] != null) {
                $this->errorsInput = $body['errorsInput'];
            }
            
            
            if (@$body['success'] !== true) {
                $this->errorPopup = 'Failed ! '.@$body['message'];
                return;
            }
            $this->id = $body['data']['id'];
            
            
            
            // UPDATE RESPONSE
            updateResponse:

            
            
            if (@$this->newattachment != null) {
                # code...
                $this->attachmentSave();
                
            }
            

            if (in_array(( int ) $responseStatus, [0,1,2,3,4]) ){
                $this->responseData = $this->setResponse($responseStatus);
            }
            
            if (@$this->responseData['success'] == true) {
                if (in_array(( int ) $responseStatus, [1,2])) {
                            // code...
            
                            // $this->js('window.location.reload()'); 
                            $this->successPopup = "Update Success!";
                }
            }
            else{
                $this->errorPopup = "Cant Response!".@$this->responseData['message'];
            }

            // if (@$_GET['id'] == null ){
            //     return $this->redirect('/pengajuan_approval_form?id='.$this->id);
            // }
            
            
            
            
        }

        
        function setResponse($responseStatus = 3) {
            if ($this->orlansoft == null) {
                $this->errorPopup = "Anda belum memilih Orlansoft !";
                $this->errorsInput['orlansoft'][] ="Required";
                return;
            }
            if ($this->id == null) {
                $this->errorPopup = "Gagal !";
                $this->errorsInput['id'][] ="Required";
                return;
            }
            // if ($responseStatus == null) {
            //     $this->errorPopup = "Gagal !";
            //     $this->errorsInput['response'][] ="Required";
            //     return;
            // }

            $ret = livewire::postHTTP('api/request/response/'.$this->orlansoft,[
                'id'=>$this->id,
                'response'=>$responseStatus
            ]);

            if (@$ret['success']==true) {
                // code...
                $this->response = $responseStatus;
            }

            
            return $ret;
        }

        public function initSearch() {
            $this->searchShow = true;
            $this->searchTransaction();
        }

        public function stopSearch() {
            $this->searchShow = false;
            $this->searchReturn = null;
        }
        
        
        public function searchTransaction() {

            
            if ($this->searchShow != true) {
                return;
                # code...
            }

            
            if (@$this->orlansoft != null && @$this->transactiontype_id != null) {
                
                $apiURL = config('web.APIHost')
                .'api/request/'
                .$this->orlansoft
                .'/orlansofttransaction/'
                .$this->transactiontype_id
                .'?q='
                .$this->searchQuery
                .'&orderby=trdate|desc&perpage=10';
                $this->searchReturn = livewire::getHTTP($apiURL);
                
                $this->errorsInput = null;
                
                if (@$this->searchReturn['success'] == true) if (@$this->searchReturn['data'][0] == null) {
                    $this->errorsInput['searchQuery'][0] = "Data is not found !";
                }
            }
        }

        function attachmentSave ()  {
            if (config('web.mode') == 'local') {
                return $this->uploadLocal();
            }
            
            if (@$this->newattachment == null) {
                $this->errorsInput['newattachment'][] = 'Required !';
                // return;
                # code...
            }
            
$originalFileName = $this->newattachment->getClientOriginalName();
$originalFilePath = $this->newattachment->getPathname();
$tempDirectory = storage_path('app/temp');
$this->newattachment->storeAs(path: 'temp', name: $originalFileName);
$fileRealPath = $tempDirectory . DIRECTORY_SEPARATOR . $originalFileName;


// copy($originalFilePath, $tempDirectory . DIRECTORY_SEPARATOR . $originalFileName);
            
            $this->newattachment = null;
            $this->notes = null;
            $upload = livewire::postHTTP('api/attachment/upload',[
                'module' => 'request',
                'ref_id' => $this->id,
                [
                    'name' => 'file',
                    'contents' => fopen($fileRealPath, 'r')
                ],
                'notes' => $this->notes
            ]);
            
            if (@$upload['success'] != true) {
                $this->errorPopup = 'Failed ! '. @$upload['message'];
                $this->errorsInput['newattachment'] = $upload['errorsInput']['file'];
                $this->errorsInput['notes'] = $upload['errorsInput']['notes'];
                
                # code...
            }
            $this->newAttachmentField = false;
            
            unlink($fileRealPath);
            $this->newattachment = null;
            $this->notes = null;
            $this->initAttachment();

            
        }

        public function deleteAttachment($id) {
           $r =  livewire::deleteHTTP('api/attachment/'.$id);
            // $this->initRequest();
            // $this->attachments = null;
            if ($this->a_way_to_face_bug === 'uploaded') {
                $this->a_way_to_face_bug = null;
                $this->js('window.location.reload()'); 
            }
            $this->initAttachment();
            
            // $this->dispatch('rebuildAttachments');
        }
        
        public function cancelAttachment($closeField = 'no') {
            $this->newattachment = null;
            $this->notes = null;

            if($closeField == 'yes') $this->newAttachmentField = null;
        }

        function initOrlansoft() {
            $this->orlansoftOptions = @((
                livewire::getHTTP(config('web.APIHost').'api/orlansoftuser')))['data'];
            }
            
            
            function initTransactionType() {
                $this->transactiontypeOptions = @((
                    livewire::getHTTP(config('web.APIHost').'api/transactiontype')))['data'];
                }
            
           public function initAttachment() {
                if (@$this->id != null) {
                    @$atts = livewire::getHTTP('api/attachment/request/'.$this->id);
                    # code...
                    $this->attachments = @$atts['data'];
                    
                }
            }
                
            
            function initRequest() {
                
                if (@$_GET['id'] != null) {

                    # code...
                    $this->returnData = livewire::getHTTP('api/request/'.$_GET['id']);

                    $this->urltoshare = env('APP_URL').'/pengajuan_approval_form?id='.$_GET['id'];
                    }
                    if (@$this->returnData['success']) {
                        $this->id = $this->returnData['data']['id'];
                        $this->title = $this->returnData['data']['title'];
                        $this->orlansoft = $this->returnData['data']['orlansoft_id'];
                        $this->transactiontype_id = $this->returnData['data']['transactiontype_id'];
                        $this->requesttype_id = $this->returnData['data']['requesttype_id'];
                        $this->trno = $this->returnData['data']['trno'];
                        $this->remarks = $this->returnData['data']['remarks'];
                        $this->response = $this->returnData['data']['response'];
                        $this->requestor = $this->returnData['data']['requestor'];
                        $this->responser = $this->returnData['responser'];


                        try {
                            $user = (((array) json_decode($_COOKIE['user'])));
                            $this->isRequestor = @$user['id'] == @$this->requestor ? true : false;
                            // dump(@$this);
                            if(@$this->responser[0] != null)
                            foreach ($this->responser as $r) {
                                # code...
                                if ($r['user_id'] == $user['id']) {
                                    $this->isResponser = true;
                                    break;
                                }
                            }
                            //code...
                        } catch (\Exception $e){}

                        // dump(@$this);
                        
                        
                        
                    }
                }
                
                
                public function render()
                {
                    if ($this->searchShow == true) {
                        $this->searchTransaction();
                    }

                    
                    
                    return view('livewire.admin.modules.pengajuan-approval-form');
                }

    public function uploadLocal(){


        // try {

            $ref_id = $this->id;
            $module = 'request';
            $notes = $this->notes;
            $fileName = $module . '.' . $ref_id . '.' . date("Y-m-d_H.i.s") . '.' . Str::random(8) . '.' . $this->newattachment->extension();

            $originalFileName = $this->newattachment->getClientOriginalName();
            $originalFilePath = $this->newattachment->getPathname();
            // $tempDirectory = storage_path('app/uploads');
            
            
        
            if ($this->newattachment->storeAs(path: 'uploads', name: $fileName)) {
                $data = Attachment::create([
                    'module' => $module,
                    'ref_id' => $ref_id,
                    'path' => 'uploads/'.$fileName,
                    'notes' => $notes??null,
                    'originalname' => $originalFileName,
                    'filetype' => $this->newattachment->getMimeType(),
                ]);
                $data->public = route('attachment.public', ['aid' => $data->id, 'filename' => $data->originalname]);
                $this->uploadData = [
                    'success' => true,
                    'message' => "Upload success",
                    'data' => $data
                ];
            }
            else{

               
                    $this->errorPopup = 'Failed ! Cant upload';
            }

        // } catch (\Illuminate\Database\QueryException $e) {
        //      $this->errorPopup = ' System Failed ! Cant upload';
        // }
        
        $this->newattachment = null;
        $this->notes = null;
        $this->newAttachmentField = false;
        $this->a_way_to_face_bug = 'uploaded';
        $this->initAttachment();
        // $this->js('window.location.reload()'); 

        
            // $this->dispatchBrowserEvent('refreshPage');

    }
            }
            