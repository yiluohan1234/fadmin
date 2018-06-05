<?php
use Illuminate\Database\Seeder;
use App\Models\User;
//php artisan make:seeder UsersTableSeeder
class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // 获取 Faker 实例
        $faker = app(Faker\Generator::class);

        // 生成数据集合
        $users = factory(User::class)
                        ->times(10)
                        ->make();

        // 让隐藏字段可见，并将数据集合转换为数组
        $user_array = $users->makeVisible(['password', 'remember_token'])->toArray();
        // 插入到数据库中
        User::insert($user_array);

        $users = User::all();
        foreach($users as $user){
            // 单独处理第一个用户的数据
            if ($user->id == 1){
                $user->name = 'yiluohan1234';
                $user->email = '1097189275@qq.com';
                $user->save();
                // 初始化用户角色，将 1 号为『管理员』
                $user->assignRole('admin');
            }else{
                // 其他用户为user
                $user->assignRole('user');
            }
        }
    }
}
