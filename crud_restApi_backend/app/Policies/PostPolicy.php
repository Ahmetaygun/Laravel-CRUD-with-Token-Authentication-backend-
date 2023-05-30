<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Admin;
use App\Models\Post;

use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;


    public function create_post_by_admin(Admin $admin)
    {
    
    if($admin->getTable()=='admins')
      {
          return true;
      }

    }

    public function update_by_admin(Admin $admin, Post $post)
    {
      if($admin->id==$post->admin_id){
          return true;
      }
    }

    public function delete_by_admin(Admin $admin, Post $post)
    {   
      if($admin->id==$post->admin_id){
       return true;
      }    
    }



}
