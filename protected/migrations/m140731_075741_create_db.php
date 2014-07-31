<?php

class m140731_075741_create_db extends CDbMigration
{
	public function up()
	{
        $this->createTable('comment', array(
            'comment_id' => 'int(10) NOT NULL AUTO_INCREMENT',
            'tutorial_id' => 'int(10) NOT NULL',
            'owner_id' => 'int(10) NOT NULL',
            'content' => 'text NOT NULL',
            'rating' => 'int(10) NOT NULL',
            'CONSTRAINT comment_pk PRIMARY KEY (comment_id)',
        ));

        $this->createTable('tags', array(
            'tag_id' => 'int(10) NOT NULL AUTO_INCREMENT',
            'title' => 'varchar(64) NOT NULL',
            'CONSTRAINT tags_pk PRIMARY KEY (tag_id)',
        ));

        $this->createTable('tags_tutorials', array(
            'tag_id' => 'int(10) NOT NULL',
            'tutorial_id' => 'int(10) NOT NULL',
            'CONSTRAINT tags_tutorials_pk PRIMARY KEY (tag_id,tutorial_id)',
        ));

        $this->createTable('tutorials', array(
            'tutorial_id' => 'int(10) NOT NULL AUTO_INCREMENT',
            'owner_id' => 'int(10) NOT NULL',
            'origin_id' => 'int(10) NOT NULL',
            'content' => 'text NOT NULL',
            'rating' => 'int(10) NOT NULL',
            'views' => 'int(10) NOT NULL',
            'title' => 'varchar(128) NOT NULL',
            'create_date' => 'datetime NOT NULL',
            'update_date' => 'datetime NOT NULL',
            'CONSTRAINT tutorials_pk PRIMARY KEY (tutorial_id)',
        ));

        $this->createTable('users', array(
            'user_id' => 'int(10) NOT NULL AUTO_INCREMENT',
            'username' => 'varchar(256) NOT NULL',
            'password' => 'varchar(256) NOT NULL',
            'email' => 'varchar(256) NOT NULL',
            'role' => "varchar(30) NOT NULL DEFAULT 'user' CHECK (role='user'||role='admin')",
            'status' => "varchar(30) NOT NULL DEFAULT 'active' CHECK (status='active'||status='banned')",
            'rating' => 'int(10) NOT NULL',
            'CONSTRAINT users_pk PRIMARY KEY (user_id)',
        ));

        $this->addForeignKey('comment_tutorials', 'comment', 'tutorial_id',
                             'tutorials', 'tutorial_id', 'CASCADE', 'CASCADE');

	    $this->addForeignKey('comment_users', 'comment', 'owner_id',
                             'users', 'user_id', 'CASCADE', 'CASCADE');

        $this->addForeignKey('tutorials_tutorials', 'tutorials', 'origin_id',
                             'tutorials', 'tutorial_id', 'CASCADE', 'CASCADE');

        $this->addForeignKey('tutorials_users', 'tutorials', 'owner_id',
                             'users', 'user_id', 'CASCADE', 'CASCADE');

        $this->addForeignKey('tags_tags_tutorials', 'tags_tutorials', 'tag_id',
                             'tags', 'tag_id', 'CASCADE', 'CASCADE');

        $this->addForeignKey('tags_tutorials_tutorials', 'tags_tutorials', 'tutorial_id',
                             'tutorials', 'tutorial_id', 'CASCADE', 'CASCADE');
    }

	public function down()
	{
        $this->dropTable('comment');
        $this->dropTable('tags_tutorials');
        $this->dropTable('tags');
        $this->dropTable('tutorials');
        $this->dropTable('users');
	}
}