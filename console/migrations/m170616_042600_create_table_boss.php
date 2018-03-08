<?php

use yii\db\Migration;

class m170616_042600_create_table_boss extends Migration
{
    public function up()
    {
		$this->createTable('{{%owner}}', [
			'owner_id' => $this->primaryKey(),
			'owner_name' => $this->string(32),
			'owner_parent' => $this->integer(),
		]);
		
		$this->createTable('{{%role}}', [
			'role_id' => $this->primaryKey(),
			'role_name' => $this->string(16),
			'role_owner' => $this->integer(),
		]);
		
		$this->insert('{{%role}}', [
			'role_name' => 'Masters',
			'role_owner' => 0,
		]);
		
		$this->createTable('{{%action}}', [
			'action_id' => $this->primaryKey(),
			'action_name' => $this->string(32),
			'action_match' => $this->string(64),
			'action_type' => $this->string(16),
			'action_parent' => $this->integer(),
			'action_desc' => $this->text(),
		]);
		
		$this->createTable('{{%privilege}}', [
			'privilege_id' => $this->primaryKey(),
			'privilege_action' => $this->integer() -> notNull(),
			'privilege_role' => $this->integer() -> notNull(),
		]);
		
		$this->createTable('{{%operator}}', [
			'operator_id' => $this->primaryKey(),
			'operator_name' => $this->string(32) -> notNull()->unique(),
			'operator_pswd' => $this->string(128) -> notNull()
		]);
		
		$this->insert('{{%operator}}', [
			'operator_name' => 'master',
			'operator_pswd' => md5('123456'),
		]);
		
		$this->createTable('{{%role_attach}}', [
			'role_attach_id' => $this->primaryKey(),
			'role_attach_operator' => $this->integer(),
			'role_attach_role' => $this->integer(),
		]);
		
		$this->insert('{{%role_attach}}', [
			'role_attach_operator' => 1,
			'role_attach_role' => 1,
		]);
		
		$this->createTable('{{%menu}}', [
			'menu_id' => $this->primaryKey(),
			'menu_title' => $this->string(32) -> notNull(),
			'menu_icon' => $this->string(32),
			'menu_href' => $this->string(64),
			'menu_parent' => $this->integer(),
			'menu_order' => $this->integer(),
		]);
		
		$this->batchInsert('{{%menu}}', ['menu_title', 'menu_href', 'menu_icon', 'menu_order'],
			[
				['主页', 'admin/default/index', 'dashboard', 0],
				['菜单管理', 'admin/menu/index', 'th', 0],
				['设备管理', 'admin/device/index', 'gear', 1],
				['公司管理', 'admin/owner/index', 'sitemap', 2],
				['角色管理', 'admin/role/index', 'group', 3],
				['操作员管理', 'admin/operator/index', 'user', 4],
				['动作管理', 'admin/action/index', 'gavel', 5],
				['权限管理', 'admin/privilege/index', 'key', 6],
			]
		);
		$this->batchInsert('{{%action}}', ['action_name', 'action_match', 'action_type', 'action_parent'], 
			[
				['菜单-主页', '1', 'menu', 0],	
				['菜单-菜单管理', '2', 'menu', 0],
				['菜单-设备管理', '3', 'menu', 0],
				['菜单-公司管理', '4', 'menu', 0],
				['菜单-角色管理', '5', 'menu', 0],
				['菜单-操作员管理', '6', 'menu', 0],
				['菜单-动作管理', '7', 'menu', 0],
				['菜单-权限管理', '8', 'menu', 0],
				//9
				['菜单管理', 'admin/menu/index', 'action', 0],
					['菜单管理-添加', 'admin/menu/create', 'action', 9],
					['菜单管理-编辑', 'admin/menu/update', 'action', 9],
				['菜单管理-查看', 'admin/menu/view', 'action', 9],
				['菜单管理-删除', 'admin/menu/delete', 'action', 9],
				//14
				['设备管理', 'admin/device/index', 'action', 0],
				['设备管理-添加', 'admin/device/create', 'action', 14],
				['设备管理-编辑', 'admin/device/update', 'action', 14],
				['设备管理-查看', 'admin/device/view', 'action', 14],
				['设备管理-删除', 'admin/device/delete', 'action', 14],
				['设备管理-导入', 'admin/device/import', 'action', 14],
				['设备管理-导入检查', 'admin/device/import', 'action', 14],
				['设备管理-导出', 'admin/device/outport', 'action', 14],
				['设备管理-控制', 'admin/device/control', 'action', 14],
				//23
				['公司管理', 'admin/owner/index', 'action', 0],
					['公司管理-添加', 'admin/owner/create', 'action', 23],
					['公司管理-编辑', 'admin/owner/update', 'action', 23],
				['公司管理-查看', 'admin/owner/view', 'action', 23],
				['公司管理-删除', 'admin/owner/delete', 'action', 23],
				//28
				['角色管理', 'admin/role/index', 'action', 0],
					['角色管理-添加', 'admin/role/create', 'action', 28],
					['角色管理-编辑', 'admin/role/update', 'action', 28],
				['角色管理-查看', 'admin/role/view', 'action', 28],
				['角色管理-删除', 'admin/role/delete', 'action', 28],
				//33
				['操作员管理', 'admin/operator/index', 'action', 0],
					['操作员管理-添加', 'admin/operator/create', 'action', 33],
					['操作员管理-编辑', 'admin/operator/update', 'action', 33],
				['操作员管理-查看', 'admin/operator/view', 'action', 33],
				['操作员管理-删除', 'admin/operator/delete', 'action', 33],
				//38
				['动作管理', 'admin/action/index', 'action', 0],
					['动作管理-添加', 'admin/action/create', 'action', 38],
					['动作管理-编辑', 'admin/action/update', 'action', 38],
				['动作管理-查看', 'admin/action/view', 'action', 38],
				['动作管理-删除', 'admin/action/delete', 'action', 38],
				//43
				['权限管理', 'admin/privilege/index', 'action', 0],
					['权限管理-添加', 'admin/privilege/create', 'action', 43],
					['权限管理-编辑', 'admin/privilege/update', 'action', 43],
				['权限管理-查看', 'admin/privilege/view', 'action', 43],
				['权限管理-删除', 'admin/privilege/delete', 'action', 43],
			]
		);
		
		$this->insert('{{%role}}', [
				'role_name' => 'Managers',
				'role_owner' => 0,
		]);
		
		$this->batchInsert('{{%privilege}}', ['privilege_action', 'privilege_role'],
			[
				[3, 2], [4, 2], [5, 2], [6, 2], [8, 2],
				[14, 2], [17, 2], [20, 2], [22, 2],
				[23, 2], [24, 2], [25, 2], [26, 2], [27, 2],
				[28, 2], [29, 2], [30, 2], [31, 2], [32, 2],
				[33, 2], [34, 2], [35, 2], [36, 2], [37, 2],
				[43, 2], [44, 2], [45, 2], [46, 2], [47, 2],
			]
		);
		
		$this->insert('{{%role}}', [
			'role_name' => 'Device Operators',
			'role_owner' => 0,
		]);
		
		$this->batchInsert('{{%privilege}}', ['privilege_action', 'privilege_role'],
				[
					[3, 3],
					[14, 3], [15, 3], [16, 3], [17, 3], [18, 3], [19, 3], [20, 3],
				]
		);
		
		$this->insert('{{%role}}', [
				'role_name' => 'Device Debuggers',
				'role_owner' => 0,
		]);
		
		$this->batchInsert('{{%privilege}}', ['privilege_action', 'privilege_role'],
				[
						[3, 4],
						[14, 4], [22, 4],
				]
		);
    }

    public function down()
    {
    	$this->dropTable('{{%menu}}');
    	$this->dropTable('{{%operator}}');
    	$this->dropTable('{{%privilege}}');
    	$this->dropTable('{{%action}}');
    	$this->dropTable('{{%role_attach}}');
    	$this->dropTable('{{%role}}');
    	$this->dropTable('{{%owner}}');
    	
    	return true;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
