<?php
class Logs extends Front_Controller {

     function Logs() {
        parent::Front_controller();
        //$this->load->model('Logs_model');
         $this->load->library('session');
        $this->load->library('parser');
    }

    function index() {
        $this->Log->recursive = 0;
        $this->set('logs', $this->paginate());
    }

    function getUserLogs($uid,$type,$limit){
        $this->Log->get_user_logs($uid,$type,$limit);
    }

    //SELECT distinct(logs.id),logs.name FROM `logs` left join users_friends on (users_friends.friend_id=logs.user_id or users_friends.user_id=logs.user_id) where users_friends.user_id=26

    function get_user_friend_logs($uid,$type='',$limit="") {
        $this->Log->recursive=1;
        if($type=="all" || $type=="") {
            $options['conditions']=array('UsersFriend.user_id'=>$uid);
        }else {
            $options['conditions']=array('UsersFriend.user_id'=>$uid,'Log.type'=>$type);
        }
        if($limit!="") {
            $options['limit']=$limit;
        }
        $options['fields']=array('distinct(Log.id),Log.name,Log.type,Log.user_id,Log.created,Log.image,Log.url','Log.comment_type','Log.comment_id');
        $options['order']=array('Log.created desc');
        $options['joins']=array(
            array(
            'table' => 'users_friends',
            'alias' => 'UsersFriend',
            'type' => 'inner',
            'conditions'=> array(
            'OR'=>array('UsersFriend.friend_id = Log.user_id','UsersFriend.user_id = Log.user_id'))
            )
        );

        $data=$this->Log->find("all",$options);

        return $data;
    }

    function get_username($uid) {
        return "<a href='profile/view/$uid'>".$this->requestAction('users/get_username/'.$uid)."</a>";
    }

    function get_battlename($bid) {
        $data = $this->requestAction('battles/get_battle_detail/'.$bid);
        $battle_subject = $data['Battle']['subject'];
        return "<a href='battles/detail/$bid'>".$battle_subject."</a>";
    }

    function joined_site($uid,$sitename) {
        $this->data['Log']['name']=$this->get_username($uid)." joined ".$sitename;
        $this->data['Log']['user_id']=$uid;
        $this->Log->create();
        $this->Log->save($this->data);
        //clearing profile view cache
        $this->requestAction('profile/clear_view_cache/'.$uid);
    }

    function edit_profile($uid) {
        $this->data['Log']['name']=$this->get_username($uid)." ".__('LOG_EDIT_PROFILE',true);
        $this->data['Log']['user_id']=$uid;
        $this->Log->create();
        $this->Log->save($this->data);
        //clearing profile view cache
        $this->requestAction('profile/clear_view_cache/'.$uid);
        $this->requestAction('profile/clear_personal_info_cache/'.$uid);
    }

    function upload_profile_photo($uid,$image,$id) {
        $this->data['Log']['name']=$this->get_username($uid)." ".__('LOG_PROFILE_PHOTO_UPLOAD',true)."<a href='".$this->webroot."/profile/photo/".$uid."/".$id."'> ".__('PHOTO',true)." </a>" ;
        $this->data['Log']['user_id']=$uid;
        $this->data['Log']['type']="photo";
        $this->data['Log']['image']=USER_PICTURE_FOLDER.$image;
        $this->data['Log']['url']='profile/photo/'.$uid.'/'.$id;
        $this->Log->create();
        $this->Log->save($this->data);
        //clearing profile view cache
        $this->requestAction('profile/clear_view_cache/'.$uid);
    }

    function upload_media($mid) {
        $this->User->MediaFile->recursive=-1;
        $media_file=$this->User->MediaFile->read(null,$mid);
        if($media_file['MediaFile']['type']=="Image" ) {
            $type="photo";
            $image=USER_MEDIA_FOLDER.$media_file['MediaFile']['file_name'];
        }elseif($media_file['MediaFile']['type']=="Video") {
            $type="video";
            $json_data=@json_decode($media_file['MediaFile']['video_attributes']);
            if(file_exists('img/'.USER_MEDIA_FOLDER.$json_data->thumb)) {
                $image=USER_MEDIA_FOLDER.$json_data->thumb;
            }else {
                $image="video_img.png";
            }
        }elseif($media_file['MediaFile']['type']=="Audio") {
            $type="audio";
            $image="audio_img.jpg";
        }elseif($media_file['MediaFile']['type']=="Text") {
            $type="text";
            $image="text.png";
        }
        $this->data['Log']['name']=$this->get_username($media_file['MediaFile']['user_id'])." ".__('LOG_UPLOAD_NEW',true)." ".$type." <a href='media/view/".$mid."'>".$media_file['MediaFile']['title']."</a>";
        $this->data['Log']['user_id']=$media_file['MediaFile']['user_id'];
        $this->data['Log']['type']="photo";
        $this->data['Log']['image']=$image;
        $this->data['Log']['url']='media/view/'.$mid;
        $this->Log->create();
        $this->Log->save($this->data);
    //clearing profile view cache
    //$this->requestAction('profile/clear_view_cache/'.$uid);
    }

    function comment_media($uid,$message,$type,$image,$mid,$owner,$comment_id) {

        $this->User->MediaFile->recursive=-1;
        $media_file=$this->User->MediaFile->read(null,$mid);
        if($media_file['MediaFile']['type']=="Image") {
            $type="photo";
            $image=USER_MEDIA_FOLDER.$media_file['MediaFile']['file_name'];
        }elseif($media_file['MediaFile']['type']=="Video") {
            $type="video";
            $json_data=@json_decode($media_file['MediaFile']['video_attributes']);
            if(file_exists('img/'.USER_MEDIA_FOLDER.$json_data->thumb)) {
                $image=USER_MEDIA_FOLDER.$json_data->thumb;
            }else {
                $image="video_img.png";
            }
        }elseif($media_file['MediaFile']['type']=="Audio") {
            $type="audio";
            $image="audio_img.jpg";
        }elseif($media_file['MediaFile']['type']=="Text") {
            $type="text";
            $image="text.png";
        }
        $this->data['Log']['name']=rawurldecode($message);
        $this->data['Log']['user_id']=$uid;
        $this->data['Log']['type']=$type;
        $this->data['Log']['image']=$image;
        $this->data['Log']['comment_type']='media';
        $this->data['Log']['comment_id']=$comment_id;
        $this->data['Log']['url']='media/view/'.$mid;
        $this->Log->create();
        $this->Log->save($this->data);

        /*
         * for owner's log
         */
        $this->data['Log']['name']=rawurldecode($message);
        $this->data['Log']['user_id']=$owner;
        $this->data['Log']['type']=$type;
        $this->data['Log']['image']=$image;
        $this->data['Log']['comment_type']='media';
        $this->data['Log']['comment_id']=$comment_id;
        $this->data['Log']['url']='media/view/'.$mid;
        $this->Log->create();
        $this->Log->save($this->data);

    //$this->requestAction('profile/clear_view_cache/'.$uid);
    }

    function rate_media($uid,$message,$mid) {


        $this->User->MediaFile->recursive=-1;
        $media_file=$this->User->MediaFile->read(null,$mid);
        if($media_file['MediaFile']['type']=="Image") {
            $type="photo";
            $image=USER_MEDIA_FOLDER.$media_file['MediaFile']['file_name'];
        }elseif($media_file['MediaFile']['type']=="Video") {
            $type="video";
            $json_data=@json_decode($media_file['MediaFile']['video_attributes']);
            if(file_exists('img/'.USER_MEDIA_FOLDER.$json_data->thumb)) {
                $image=USER_MEDIA_FOLDER.$json_data->thumb;
            }else {
                $image="video_img.png";
            }
        }elseif($media_file['MediaFile']['type']=="Audio") {
            $type="audio";
            $image="audio_img.jpg";
        }elseif($media_file['MediaFile']['type']=="Text") {
            $type="text";
            $image="text.png";
        }
        $this->data['Log']['name']=rawurldecode($message);
        $this->data['Log']['user_id']=$uid;
        $this->data['Log']['type']=$type;
        $this->data['Log']['image']=$image;
        $this->data['Log']['url']='media/view/'.$mid;
        $this->Log->create();
        $this->Log->save($this->data);
        /*
         * for media owner
         */
        $this->data['Log']['name']=rawurldecode($message);
        $this->data['Log']['user_id']=$media_file['MediaFile']['user_id'];
        $this->data['Log']['type']=$type;
        $this->data['Log']['image']=$image;
        $this->data['Log']['url']='media/view/'.$mid;
        $this->Log->create();
        $this->Log->save($this->data);
        $this->requestAction('profile/clear_view_cache/'.$uid);
    }

    function add_blog($uid,$message,$bid) {
        $this->data['Log']['name']=rawurldecode($message);
        $this->data['Log']['user_id']=$uid;
        $this->data['Log']['type']='Blog';
        $this->data['Log']['image']='';
        $this->data['Log']['url']='profile/blog/'.$uid.'/'.$bid;
        $this->Log->create();
        $this->Log->save($this->data);
        $this->requestAction('profile/clear_view_cache/'.$uid);
    }

    function comment_blog($uid,$message,$bid,$buid,$comment_id) {
        $this->data['Log']['name']=rawurldecode($message);
        $this->data['Log']['user_id']=$uid;
        $this->data['Log']['type']='Blog';
        $this->data['Log']['image']='';
        $this->data['Log']['comment_type']='blog_comment';
        $this->data['Log']['comment_id']=$comment_id;
        $this->data['Log']['url']='profile/blog/'.$buid.'/'.$bid;
        $this->Log->create();
        $this->Log->save($this->data);
        /*
         * for blog creator
         */
        $this->data['Log']['name']=rawurldecode($message);
        $this->data['Log']['user_id']=$buid;
        $this->data['Log']['type']='Blog';
        $this->data['Log']['image']='';
        $this->data['Log']['comment_type']='blog_comment';
        $this->data['Log']['comment_id']=$comment_id;
        $this->data['Log']['url']='profile/blog/'.$buid.'/'.$bid;
        $this->Log->create();
        $this->Log->save($this->data);
        $this->requestAction('profile/clear_view_cache/'.$uid);
    }

    function comment_link($uid,$message,$bid,$buid,$comment_id) {
        $this->data['Log']['name']=rawurldecode($message);
        $this->data['Log']['user_id']=$uid;
        $this->data['Log']['type']='Link';
        $this->data['Log']['image']='';
        $this->data['Log']['comment_type']='link_comment';
        $this->data['Log']['comment_id']=$comment_id;
        $this->data['Log']['url']='profile/view_link/'.$buid.'/'.$bid;
        $this->Log->create();
        $this->Log->save($this->data);

        /*
         * for blog owner's log
         */
        $this->data['Log']['name']=rawurldecode($message);
        $this->data['Log']['user_id']=$buid;
        $this->data['Log']['type']='Link';
        $this->data['Log']['image']='';
        $this->data['Log']['comment_type']='link_comment';
        $this->data['Log']['comment_id']=$comment_id;
        $this->data['Log']['url']='profile/view_link/'.$buid.'/'.$bid;
        $this->Log->create();
        $this->Log->save($this->data);
    //$this->requestAction('profile/clear_view_cache/'.$uid);
    }

    function add_link($uid,$message,$bid) {
        $this->data['Log']['name']=rawurldecode($message);
        $this->data['Log']['user_id']=$uid;
        $this->data['Log']['type']='Link';
        $this->data['Log']['image']='';
        $this->data['Log']['url']='profile/view_link/'.$uid.'/'.$bid;
        $this->Log->create();
        $this->Log->save($this->data);
        $this->requestAction('profile/clear_view_cache/'.$uid);
    }

    function comment_photo($uid,$message,$image,$bid,$creator,$comment_id) {
        $this->data['Log']['name']=rawurldecode($message);
        $this->data['Log']['user_id']=$uid;
        $this->data['Log']['type']='Photo';
        $this->data['Log']['comment_type']='photo_comment';
        $this->data['Log']['comment_id']=$comment_id;
        $this->data['Log']['image']='avatars/'.$image;
        $this->data['Log']['url']='profile/photo/'.$creator.'/'.$bid;
        $this->Log->create();
        $this->Log->save($this->data);
        /*
         * for photo owner's log
         */
        $this->data['Log']['name']=rawurldecode($message);
        $this->data['Log']['user_id']=$creator;
        $this->data['Log']['type']='Photo';
        $this->data['Log']['comment_type']='photo_comment';
        $this->data['Log']['comment_id']=$comment_id;
        $this->data['Log']['image']='avatars/'.$image;
        $this->data['Log']['url']='profile/photo/'.$creator.'/'.$bid;
        $this->Log->create();
        $this->Log->save($this->data);
    //$this->requestAction('profile/clear_view_cache/'.$uid);
    }

    function add_theartre_ad($uid,$message,$bid) {
        $this->data['Log']['name']=rawurldecode($message);
        $this->data['Log']['user_id']=$uid;
        $this->data['Log']['type']='Theatre Ad';
        $this->data['Log']['image']='';
        $this->data['Log']['url']='talent_hunter_theatre/detail/'.$bid;
        $this->Log->create();
        $this->Log->save($this->data);
        $this->requestAction('profile/clear_view_cache/'.$uid);
    }

    function become_fan($uid,$message,$bid) {
        $this->data['Log']['name']=rawurldecode($message);
        $this->data['Log']['user_id']=$uid;
        $this->data['Log']['type']='Become Fan';
        $this->data['Log']['image']='';
        $this->data['Log']['url']='profile/view/'.$bid;
        $this->Log->create();
        $this->Log->save($this->data);

        $this->data['Log']['name']=rawurldecode($message);
        $this->data['Log']['user_id']=$bid;
        $this->data['Log']['type']='Become Fan';
        $this->data['Log']['image']='';
        $this->data['Log']['url']='profile/view/'.$bid;
        $this->Log->create();
        $this->Log->save($this->data);
        $this->requestAction('profile/clear_view_cache/'.$bid);
        $this->requestAction('profile/clear_view_cache/'.$uid);
    }

    function become_friend($uid,$message,$bid) {
        $this->data['Log']['name']=rawurldecode($message);
        $this->data['Log']['user_id']=$uid;
        $this->data['Log']['type']='Become Friend';
        $this->data['Log']['image']='';
        $this->data['Log']['url']='profile/view/'.$bid;
        $this->Log->create();
        $this->Log->save($this->data);

        $this->data['Log']['name']=rawurldecode($message);
        $this->data['Log']['user_id']=$bid;
        $this->data['Log']['type']='Become Friend';
        $this->data['Log']['image']='';
        $this->data['Log']['url']='profile/view/'.$bid;
        $this->Log->create();
        $this->Log->save($this->data);
    //        $this->requestAction('profile/clear_view_cache/'.$uid);
    //        $this->requestAction('profile/clear_view_cache/'.$bid);
    //        $this->requestAction('profile/clear_friends_cache/'.$uid);
    //        $this->requestAction('profile/clear_friends_cache/'.$bid);
    }

    function create_group($uid,$message,$bid) {
        $this->data['Log']['name']=rawurldecode($message);
        $this->data['Log']['user_id']=$uid;
        $this->data['Log']['type']='Group/Fan club';
        $this->data['Log']['image']='';
        $this->data['Log']['url']='my_networks/group/'.$bid;
        $this->Log->create();
        $this->Log->save($this->data);
    //$this->requestAction('profile/clear_view_cache/'.$uid);
    }

    function comment_group($uid,$message,$bid,$creator,$comment_id) {
        $this->data['Log']['name']=rawurldecode($message);
        $this->data['Log']['user_id']=$uid;
        $this->data['Log']['type']='Group/Fan club';
        $this->data['Log']['image']='';
        $this->data['Log']['comment_type']='group_comment';
        $this->data['Log']['comment_id']=$comment_id;
        $this->data['Log']['url']='my_networks/group/'.$bid;
        $this->Log->create();
        $this->Log->save($this->data);

        $this->data['Log']['name']=rawurldecode($message);
        $this->data['Log']['user_id']=$creator;
        $this->data['Log']['type']='Group/Fan club';
        $this->data['Log']['image']='';
        $this->data['Log']['comment_type']='group_comment';
        $this->data['Log']['comment_id']=$comment_id;
        $this->data['Log']['url']='my_networks/group/'.$bid;
        $this->Log->create();
        $this->Log->save($this->data);
    //$this->requestAction('profile/clear_view_cache/'.$uid);
    }

    function comment_group_image($uid,$message,$image,$gid,$bid,$creator) {
        $this->data['Log']['name']=rawurldecode($message);
        $this->data['Log']['user_id']=$uid;
        $this->data['Log']['type']='Image';
        $this->data['Log']['image']='';
        $this->data['Log']['url']='my_networks/group_photo/'.$gid.'/'.$bid;
        $this->Log->create();
        $this->Log->save($this->data);
        /*
         * for creator's log
         */
        $this->data['Log']['name']=rawurldecode($message);
        $this->data['Log']['user_id']=$creator;
        $this->data['Log']['type']='Image';
        $this->data['Log']['image']='';
        $this->data['Log']['url']='my_networks/group_photo/'.$gid.'/'.$bid;
        $this->Log->create();
        $this->Log->save($this->data);
        $this->requestAction('profile/clear_view_cache/'.$uid);
    }

    function like_status($uid,$message,$bid,$id) {
        $this->Log->recursive=-1;

        $this->data['Log']['name']=rawurldecode($message);
        $this->data['Log']['user_id']=$bid;
        $this->data['Log']['type']='Status Like';
        $this->data['Log']['image']='';
        $this->data['Log']['url']='my_famess/life_today/'.$bid;
        $this->data['Log']['comment_type']='Like Log';
        $this->data['Log']['comment_id']=$id;
        $this->Log->create();
        $this->Log->save($this->data);

        $this->data['Log']['name']=rawurldecode($message);
        $this->data['Log']['user_id']=$uid;
        $this->data['Log']['type']='Status Like';
        $this->data['Log']['image']='';
        $this->data['Log']['url']='my_famess/life_today/'.$bid;
        $this->data['Log']['comment_type']='Like Log';
        $this->data['Log']['comment_id']=$id;
        $this->Log->create();
        $this->Log->save($this->data);


        $logData=$this->Log->find('first',array('conditions'=>array('Log.id'=>$this->Log->id),'fields'=>array('Log.id','Log.created','Log.name','Log.user_id','Log.comment_id')));
        return $logData;
    //$this->requestAction('profile/clear_view_cache/'.$uid);
    }

    function comment_status($uid,$message,$bid) {
        $this->data['Log']['name']=rawurldecode($message);
        $this->data['Log']['user_id']=$uid;
        $this->data['Log']['type']='Status Comment';
        $this->data['Log']['image']='';
        $this->data['Log']['url']='my_famess/life_today/'.$bid;
        $this->Log->create();
        $this->Log->save($this->data);
        /*
         * comment status
         */
        $this->data['Log']['name']=rawurldecode($message);
        $this->data['Log']['user_id']=$bid;
        $this->data['Log']['type']='Status Comment';
        $this->data['Log']['image']='';
        $this->data['Log']['url']='my_famess/life_today/'.$bid;
        $this->Log->create();
        $this->Log->save($this->data);
    //$this->requestAction('profile/clear_view_cache/'.$uid);
    }

    function comment_battle($user_id,$message,$id,$creator,$comment_id) {
        $this->data['Log']['name']=rawurldecode($message);
        $this->data['Log']['user_id']=$user_id;
        $this->data['Log']['type']='Battle Comment';
        $this->data['Log']['image']='';
        $this->data['Log']['comment_type']='battle_comment';
        $this->data['Log']['comment_id']=$comment_id;
        $this->data['Log']['url']='battles/detail/'.$id;
        $this->Log->create();
        $this->Log->save($this->data);
        /*
         * comment status
         */
        $this->data['Log']['name']=rawurldecode($message);
        $this->data['Log']['user_id']=$creator;
        $this->data['Log']['type']='Battle Comment';
        $this->data['Log']['comment_type']='battle_comment';
        $this->data['Log']['comment_id']=$comment_id;
        $this->data['Log']['image']='';
        $this->data['Log']['url']='battles/detail/'.$id;
        $this->Log->create();
        $this->Log->save($this->data);
    }

    function add_ad($uid,$message,$aid) {
        $this->data['Log']['name']=rawurldecode($message);
        $this->data['Log']['user_id']=$uid;
        $this->data['Log']['type']='Theatre Ad';
        $this->data['Log']['image']='';
        $this->data['Log']['url']='talent_hunter_theatres/detail/'.$bid;
        $this->Log->create();
        $this->Log->save($this->data);
        $this->requestAction('profile/clear_view_cache/'.$uid);
    }

    function add_news($uid,$message,$aid) {
        $this->data['Log']['name']=rawurldecode($message);
        $this->data['Log']['user_id']=$uid;
        $this->data['Log']['type']='News';
        $this->data['Log']['image']='';
        $this->data['Log']['url']='newsheralds/view/'.$aid;
        $this->Log->create();
        $this->Log->save($this->data);
        $this->requestAction('profile/clear_view_cache/'.$uid);
    }

    function contest_winner($uid,$message,$cid) {
        $this->data['Log']['name']=rawurldecode($message);
        $this->data['Log']['user_id']=$uid;
        $this->data['Log']['type']='Contest';
        $this->data['Log']['image']='';
        $this->data['Log']['url']='contests/view/'.$cid;
        $this->Log->create();
        $this->Log->save($this->data);
        $this->requestAction('profile/clear_view_cache/'.$uid);
    }

    function add_subscriber($uid,$message,$cid) {
        $this->data['Log']['name']=rawurldecode($message);
        $this->data['Log']['user_id']=$uid;
        $this->data['Log']['type']='Contest Subcriber';
        $this->data['Log']['image']='';
        $this->data['Log']['url']='contests/view/'.$cid;
        $this->Log->create();
        $this->Log->save($this->data);
        $this->requestAction('profile/clear_view_cache/'.$uid);
    }

    function comment_log($uid,$message,$creator,$log_id) {
        $this->data['Log']['name']=rawurldecode($message);
        $this->data['Log']['user_id']=$creator;
        $this->data['Log']['type']='Comment Log';
        $this->data['Log']['image']='';
        $this->data['Log']['url']='my_famess/logs';
        $this->data['Log']['comment_type']='Comment Log';
        $this->data['Log']['comment_id']=$log_id;
        $this->Log->create();
        $this->Log->save($this->data);
        $this->data['Log']['name']=rawurldecode($message);
        $this->data['Log']['user_id']=$uid;
        $this->data['Log']['type']='Comment Log';
        $this->data['Log']['image']='';
        $this->data['Log']['url']='my_famess/logs';
        $this->data['Log']['comment_type']='Comment Log';
        $this->data['Log']['comment_id']=$log_id;
        $this->Log->create();
        $this->Log->save($this->data);

        $logData=$this->Log->find('first',array('conditions'=>array('Log.id'=>$this->Log->id),'fields'=>array('Log.id','Log.created','Log.name','Log.user_id','Log.comment_id')));
        return $logData;

    //$this->requestAction('profile/clear_view_cache/'.$uid);
    }

    function battle_participate($bid, $uid,$creator,$subject,$battle_type,$type) {
    //        $this->
    //        $subject = $this->Battle->find('first', array('conditions'=>array('Battle.id'=>$bid)));
    //        $battle_subject = $subject['Battle']['subject'];
    //        $battle_type = $subject['Battle']['battle_type'];
        if($battle_type == 'FFA')
            $image = 'icons/fifa_icon.jpg';
        else
            $image = 'icons/championship_battle_icon.jpg';
       // echo $uid,$creator; exit;
       //echo $this->get_username($uid)." ".__('HAS_PARICIPATED',true)." ".$this->get_username($creator).__('APOSTOHEE',true)." ".$subject." ".__('BATTLE',true);
       //exit;
       if($type=='0')
           $data['Log']['name']="dsafdasf";//$this->get_username($uid)." ".__('HAS_PARICIPATED',true)." ".$this->get_username($creator).__('APOSTOHEE',true)." ".$subject." ".__('BATTLE',true);
        else
           $data['Log']['name']="dsafdasfd";//$this->get_username($uid)." ".__('HAS_CREATED',true)." ".$subject." ".__('BATTLE',true);
        $data['Log']['user_id']=$uid;
        $data['Log']['type']="photo";
        $data['Log']['image']=$image;
        $data['Log']['url']='battles/detail/'.$bid;
        $this->Log->create();
        $this->Log->save($data);
        //$this->requestAction('profile/clear_view_cache/'.$uid);
    }

    function battle_winner($bid, $uid) {
        $subject = $this->requestAction('battles/get_battle_detail/'.$bid);
        $battle_subject = $subject['Battle']['subject'];
        $battle_type = $subject['Battle']['battle_type'];
        if($battle_type == 'FFA')
            $image = 'icons/fifa_icon.jpg';
        else $image = 'icons/championship_battle_icon.jpg';
        $this->data['Log']['name']=$this->get_username($uid)." is the winner of ".$this->get_battlename($bid)." battle.";
        $this->data['Log']['user_id']=$uid;
        $this->data['Log']['type']="photo";
        $this->data['Log']['image']=$image;
        $this->data['Log']['url']='battles/detail/'.$bid;
        $this->Log->create();
        $this->Log->save($this->data);
        $this->requestAction('profile/clear_view_cache/'.$uid);
    }

    function championship_league_winner($lid, $uid, $message) {
        $league = $this->ChampionshipLeague->find('first',array('conditions'=>array('ChampionshipLeague.id'=>$lid)));
        $league_name = $league['ChampionshipLeague']['name'];
        $this->data['Log']['name']=$this->get_username($uid).$message.$league_name." league.";
        $this->data['Log']['user_id']=$uid;
        $this->data['Log']['type']="test";
        //$this->data['Log']['image']=$image;
        //$this->data['Log']['url']='battles/detail/'.$bid;
        $this->Log->create();
        $this->Log->save($this->data);
        $this->requestAction('profile/clear_view_cache/'.$uid);
    }

    function add_status($uid,$message) {
        $this->data['Log']['name']=rawurldecode($message);
        $this->data['Log']['user_id']=$uid;
        $this->data['Log']['type']='User Status';
        $this->data['Log']['image']='';
        $this->data['Log']['url']='my_networks/life_today';
        $this->Log->create();
        $this->Log->save($this->data);
        $this->requestAction('profile/clear_view_cache/'.$uid);
    }

    function add_topic($uid,$message) {
        $this->data['Log']['name']=rawurldecode($message);
        $this->data['Log']['user_id']=$uid;
        $this->data['Log']['type']='Add Topic';
        $this->data['Log']['image']='';
        $this->data['Log']['url']='profile/view/'.$uid;
        $this->Log->create();
        $this->Log->save($this->data);
        $this->requestAction('profile/clear_view_cache/'.$uid);
    }

    function like_topic($uid,$message) {
        $this->data['Log']['name']=rawurldecode($message);
        $this->data['Log']['user_id']=$uid;
        $this->data['Log']['type']='Like Topic';
        $this->data['Log']['image']='';
        $this->data['Log']['url']='profile/view/'.$uid;
        $this->Log->create();
        $this->Log->save($this->data);
        $this->requestAction('profile/clear_view_cache/'.$uid);
    }

    function comment_topic($uid,$message) {
        $this->data['Log']['name']=rawurldecode($message);
        $this->data['Log']['user_id']=$uid;
        $this->data['Log']['type']='Comment Topic';
        $this->data['Log']['image']='';
        $this->data['Log']['url']='profile/view/'.$uid;
        $this->Log->create();
        $this->Log->save($this->data);
        $this->requestAction('profile/clear_view_cache/'.$uid);
    }

    function feedback_media($uid,$message,$type,$image,$mid,$creator,$comment_id) {
        $this->User->MediaFile->recursive=-1;
        $media_file=$this->User->MediaFile->read(null,$mid);
        if($media_file['MediaFile']['type']=="Image") {
            $type="photo";
            $image=USER_MEDIA_FOLDER.$media_file['MediaFile']['file_name'];
        }elseif($media_file['MediaFile']['type']=="Video") {
            $type="video";
            $json_data=@json_decode($media_file['MediaFile']['video_attributes']);
            if(file_exists('img/'.USER_MEDIA_FOLDER.$json_data->thumb)) {
                $image=USER_MEDIA_FOLDER.$media_file['MediaFile']['file_name'];
            }else {
                $image="video_img.png";
            }
        }elseif($media_file['MediaFile']['type']=="Audio") {
            $type="audio";
            $image="audio_img.jpg";
        }elseif($media_file['MediaFile']['type']=="Text") {
            $type="text";
            $image="text.png";
        }

        $this->data['Log']['name']=rawurldecode($message);
        $this->data['Log']['user_id']=$uid;
        $this->data['Log']['type']=$type;
        $this->data['Log']['image']=$image;
        $this->data['Log']['url']='media/view/'.$mid;
        $this->data['Log']['comment_type']='media_feedback';
        $this->data['Log']['comment_id']=$comment_id;
        $this->Log->create();
        $this->Log->save($this->data);
        /*
         * for creator
         */
        $this->data['Log']['name']=rawurldecode($message);
        $this->data['Log']['user_id']=$creator;
        $this->data['Log']['type']=$type;
        $this->data['Log']['image']=$image;
        $this->data['Log']['comment_type']='media_feedback';
        $this->data['Log']['comment_id']=$comment_id;
        $this->data['Log']['url']='media/view/'.$mid;
        $this->Log->create();
        $this->Log->save($this->data);
    // $this->requestAction('profile/clear_view_cache/'.$uid);
    }

    function add_life_today() {
        Configure::write( 'debug', 0 );
        $emotion="";
        $type=$_POST['type'];
        if (!empty($_POST)) {
            if($type=="life_today") {
                $a=__('LOG_LIFE_TODAY',true);
            }else {
                $a=__('LOG_MOOD_STATEMENT',true);
            }

            $user_id=$this->data['Log']['user_id']=$this->Session->read('Auth.User.id');

            if($_POST['emotion']!="") {
                $this->data['Log']['image']=$_POST['emotion'].'.png';

            }
            $this->data['Log']['type']=$type;
            $this->data['Log']['name']=$this->requestAction("logs/get_username/".$this->Session->read('Auth.User.id')).__('LOG_LIFE_TODAY_PREFIX',true)." ".$a.": ".$_POST['content'];
            $this->Log->create();
            if($this->Log->save($this->data)) {
            //$this->requestAction('profile/clear_view_cache/'.$uid);
                $data=$this->Log->find('first',array('conditions'=>array('Log.id'=>$this->Log->id)));
                $this->set('log',$data);
            } else {
                echo 0;
                exit;
            }
        }
    }

    function user_logs($uid,$type='all',$friend='1',$from_menu="") {
    // Configure::write ( 'debug', 0 );

        $this->General->checkLogin();
        $isfriend = "yes";
        if($friend=='1') {
            if(!$this->check_friend($uid)) {
                echo __('NO_ACTIVITIES',true);
                exit;
            }
        }
        if($friend=='1')
            $logs=$this->get_user_friend_logs($uid,$type,STATUS_LIST);
        else {

            if(!$this->check_friend($uid)) {
                $isfriend = "no";
            }
            $logs=$this->get_user_logs($uid,$type,STATUS_LIST);
        }
        if($type=="all") {
            $count_status=$this->Log->find('count',array('conditions'=>array('Log.user_id'=>$uid)));
        }else {
            $count_status=$this->Log->find('count',array('conditions'=>array('Log.user_id'=>$uid,'Log.type'=>$type)));
        }

        $like_logs=Configure::read('LOG_LIKES');
        $this->layout = 'ajax';
        $this->set('logs',$logs);
        $this->set('like_logs',$like_logs);
        $this->set('type',$type);
        $this->set('count_status',$count_status);
        $this->set('uid',$uid);
        $this->set('from_menu',$from_menu);
        $this->set('title_for_layout',  __('LOGS',true));
        $this->set('isfriend', $isfriend);
    }

    function more_logs() {
        $offset=$_POST['offset'];
        $uid=$_POST['id'];
        $like_logs=Configure::read('LOG_LIKES');
        // Configure::write( 'debug', 0 );
        //        if(!$this->check_friend($uid)) {
        //            return "";
        //            exit;
        //        }

        $data=$this->Log->find('all',array('conditions'=>array('Log.user_id'=>$uid),'order'=>array('Log.created DESC'),'limit'=>STATUS_LIST,'offset'=>$offset));
        //debug($data);
        $this->set('like_logs',$like_logs);
        $this->set('statuses',$data);
    }

    function more_status_logs() {
        $offset=$_POST['offset'];
        $uid=$_POST['id'];
        $type=$_POST['type'];
        $like_logs=Configure::read('LOG_LIKES');
        Configure::write( 'debug', 0 );
        if(!$this->check_friend($uid)) {
            return "";
            exit;
        }

        $data=$this->Log->find('all',array('conditions'=>array('Log.user_id'=>$uid,'Log.type'=>$type),'order'=>array('Log.created DESC'),'limit'=>STATUS_LIST,'offset'=>$offset));
        //debug($data);
        $this->set('like_logs',$like_logs);
        $this->set('statuses',$data);
    }

    function add_wall() {
        Configure::write( 'debug', 0 );
        $type="wall";
        //print_r($_POST);
        if(!empty($_POST)) {

            $user_id=$this->Session->read('Auth.User.id');
            $uid=$_POST['uid'];
            if($this->check_friend($uid)) {
                if($user_id!=$uid) {
                    $message=$this->requestAction("logs/get_username/".$user_id)." ".__("WROTE_ON",true)." ".$this->requestAction("logs/get_username/".$uid).__('APOSTOHEE',true)." ".__("WALL",true)."".'"'.$_POST['content']." '";
                    $this->add_wall_log($user_id,$uid,rawurlencode($message));
                }
                $this->data['Log']['name']=$this->requestAction("logs/get_username/".$this->Session->read('Auth.User.id'))." ".$_POST['content'];
                $this->data['Log']['type']=$type;
                $this->data['Log']['user_id']=$uid;
                $this->Log->create();
                if($this->Log->save($this->data)) {
                //for clearing profile view cache
                //$this->requestAction('profile/clear_view_cache/'.$this->Session->read('Auth.User.id'));
                    $data=$this->Log->find('first',array('conditions'=>array('Log.id'=>$this->Log->id)));
                    $like_logs= $email_contacts = Configure::read ( 'LOG_LIKES' );;
                    $this->set('like_logs',$like_logs);
                    $this->set('log',$data);
                } else {
                    echo 0;
                    exit;
                }
            }
            else {
                echo 1;
                exit;
            }
        }

    }

    function like_comment($uid,$message,$bid,$creator) {
        $this->data['Log']['name']=rawurldecode($message);
        $this->data['Log']['user_id']=$uid;
        $this->data['Log']['type']='Comment Like';
        $this->data['Log']['image']='';
        $this->data['Log']['url']='media/view/'.$bid;
        $this->Log->create();
        $this->Log->save($this->data);
        /*
         * for owner's log
         */
        $this->data['Log']['name']=rawurldecode($message);
        $this->data['Log']['user_id']=$creator;
        $this->data['Log']['type']='Comment Like';
        $this->data['Log']['image']='';
        $this->data['Log']['url']='media/view/'.$bid;
        $this->Log->create();
        $this->Log->save($this->data);
    //$this->requestAction('profile/clear_view_cache/'.$uid);
    }

    function add_wall_log($user_id,$uid,$message) {
        $this->data['Log']['name']=rawurldecode($message);
        $this->data['Log']['user_id']=$user_id;
        $this->data['Log']['type']='Wall';
        $this->data['Log']['image']='';
        $this->data['Log']['url']='profile/view/'.$uid;
        $this->Log->create();
        $this->Log->save($this->data);
    }

    function delete_logs($id,$type) {
        return $this->Log->deleteAll(array('Log.comment_id'=>$id,'Log.comment_type'=>"$type"));
    }

    function count_logs($id,$type) {
        return $count=$this->Log->find('count',array('conditions'=>array('Log.comment_id'=>$id,'Log.comment_type'=>$type)));
    }



}
?>