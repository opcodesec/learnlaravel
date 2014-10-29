<?php

class SentrySeeder extends Seeder {

  public function run()
  {
    DB::table('users')->delete();
    DB::table('groups')->delete();
    DB::table('users_groups')->delete();

    Sentry::getUserProvider()->create(array(
      'email'      => 'admin@admin.com',
      'password'   => "admin",
      'first_name' => 'admin',
      'last_name'  => 'admin',
      'activated'  => 1,
    ));

    Sentry::getGroupProvider()->create(array(
      'name'        => 'Admin',
      'permissions' => ['admin' => 1],
    ));

    // 将用户加入用户组
    $adminUser  = Sentry::getUserProvider()->findByLogin('admin@admin.com');
    $adminGroup = Sentry::getGroupProvider()->findByName('Admin');
    $adminUser->addGroup($adminGroup);
  }
}