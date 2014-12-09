<?php

/**
 * 权限结构配置
 */
return array(
    // 菜单、页面、操作
    'nav' => array(
    	'product' => array(
    		'name'	=> '产品',
    		'item'	=> array(
    			'ProConfig' => array(
    				'name' => '配置',
    				'item' => array('index' => '查看', 'add' => '添加', 'edit' => '编辑', 'del' => '删除', 'config' => '配置'),
    			),
    			'Notice' => array(
    				'name' => '产品公告',
    				'item' => array('index' => '查看', 'add' => '添加', 'edit' => '编辑', 'del' => '删除'),
    			),
    			'AdSpace' => array(
    				'name' => '产品广告位',
    				'item' => array('index' => '查看', 'add' => '添加', 'edit' => '编辑', 'del' => '删除'),
    			),
    			'Ad' => array(
    				'name' => '产品广告',
    				'item' => array('index' => '查看', 'add' => '添加', 'edit' => '编辑', 'del' => '删除'),
    			),
    		),
    	), 
    	'channel' => array(
    		'name'	=> '栏目管理',
    		'item'	=> array(
    			'Channel' => array(
    				'name' => '栏目',
    				'item' => array('index' => '查看', 'add' => '添加', 'edit' => '编辑', 'del' => '删除'),		
    			),	
    		),		  	
    	),	
    	'course' => array(
    		'name'	=> '课程管理',
    		'item'	=> array(
    			'Course' => array(
    				'name' => '课程',
    				'item' => array('index' => '查看', 'add' => '添加', 'edit' => '编辑', 'del' => '删除'),
    			),
    			'Topic' => array(
    				'name' => '知识点',
    				'item' => array('index' => '查看', 'add' => '添加', 'edit' => '编辑', 'del' => '删除'),
    			),
    			'Section' => array(
    				'name' => '课时',
    				'item' => array('index' => '查看', 'add' => '添加', 'edit' => '编辑', 'del' => '删除'),
    			),
    		),
    	),
    	'resource' => array(
    		'name'	=> '资源管理',
    		'item'	=> array(
    			'Resource' => array(
    				'name' => '视频资源',
    				'item' => array('index' => '查看', 'add' => '添加', 'edit' => '编辑', 'del' => '删除'),
    			),
    			'Library' => array(
    				'name' => '题库资源',
    				'item' => array('index' => '查看', 'add' => '添加', 'edit' => '编辑', 'del' => '删除'),
    			),
                'Import' => array(
                    'name' => '导入数据',
    				'item' => array('index' => '查看'),
                ),
    			'Upfile' => array(
    				'name'	=> '附件',
    				'item' => array('index' => '查看', 'add' => '添加', 'edit' => '编辑', 'del' => '删除'),
    			),
    		),
    	),
        'activity' => array(
    		'name'	=> '活动管理',
    		'item'	=> array(
    			'Activity' => array(
    				'name' => '活动管理',
    				'item' => array('index' => '查看', 'add' => '添加', 'edit' => '编辑', 'del' => '删除'),
    			),
    		),
    	),
    	'user_role' => array(
    		'name'	=> '用户中心',
    		'item'	=> array(
    			'Stage' => array(
    				'name' => '龄段管理',
    				'item' => array('index' => '查看', 'add' => '添加', 'edit' => '编辑', 'del' => '删除'),
    			),
    			'User' => array(
    				'name' => '用户管理',
    				'item' => array('index' => '查看', 'add' => '添加', 'edit' => '编辑', 'del' => '删除'),
    			),
    			'Role' => array(
    				'name' => '角色管理',
    				'item' => array('index' => '查看', 'add' => '添加', 'edit' => '编辑', 'del' => '删除'),
    			),
    		),
    	),
    	'update' => array(
    		'name' => '更新缓存',
    		'item' => array(
    			'Cache' => array(
            		'name' => '更新缓存',
            		'item' => array('index' => '查看', 'update' => '更新'),
            	),
    		),
    	),
        'sys' => array(
            'name' => '系统设置',
            'item' => array(
                'SysRole' => array(
                    'name' => '系统角色管理',
                    'type'	=> 1,
                    'item' => array('index' => '查看', 'add' => '添加', 'edit' => '编辑', 'del' => '删除'),
                ),
                'SysUser' => array(
                    'name' => '系统管理员管理',
                    'type'	=> 1,
                    'item' => array('index' => '查看', 'add' => '添加', 'edit' => '编辑', 'del' => '删除'),
                ),
                'SysLog' => array(
                    'name' => '系统日志',
                    'type'	=> 1,
                    'item' => array('index' => '查看', 'clear' => '清除'),
                ),
            ),
        ),
    ),
);


