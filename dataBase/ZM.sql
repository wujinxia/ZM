create table zm_user
(
	user_id int(11) not null auto_increment,
  user_card_id char(18) not null,
	user_name char(15) not null check(user_Name !=''),
	user_password char(15) not null,
	user_email varchar(50) default null,
	user_sex varchar(2) not null default"男",
	user_school varchar(10) default "",
	user_grade varchar(10) default null,
	user_major varchar(10) default null,
	user_qq  varchar(10) default null,
	user_rp  int(10) default 0,
	user_phone varchar(15) default null,
	user_place varchar(10) default null,
	user_avatar varchar(100) not null default "zm_new_avatar.png",
	primary key(user_id)
)engine=innodb default charset=utf8;

create table zm_blog
(
	blog_id int(11) not null auto_increment,
	blog_author_id int(11) not null,
	blog_time timestamp NOT NULL default CURRENT_TIMESTAMP,
	blog_content text not null,
	blog_type varchar(10) default '1',
	blog_pic varchar(100) default null,
	primary key(blog_id)
)engine=innodb default charset=utf8;

create table zm_message
(
	message_id int(11) not null auto_increment,
	message_time timestamp NOT NULL default CURRENT_TIMESTAMP,
	message_send_id int(11) not null,
	message_receive_id int(11) not null,
	message_content text not null,
	primary key(message_id)
)engine=innodb default charset=utf8;

create table zm_comment
(
	comment_id int(11) not null auto_increment,
	comment_user_id int(11) not null,
	comment_time timestamp NOT NULL default CURRENT_TIMESTAMP,
	comment_blog_id int(11) not null,
	comment_content text not null,
	primary key(comment_id)
)engine=innodb default charset=utf8;


create table zm_blog_like
(
	like_id int(11) not null auto_increment,
	like_user_id int(11) not null,
	like_time timestamp NOT NULL default CURRENT_TIMESTAMP,
	like_blog_id int(11) not null,
	primary key(like_id)
)engine=innodb default charset=utf8;

create table zm_help_like
(
	help_id int(11) not null auto_increment,
	help_user_id int(11) not null,
	help_time timestamp NOT NULL default CURRENT_TIMESTAMP,
	help_comment_id int(11) not null,
	primary key(help_id)
)engine=innodb default charset=utf8;

create table zm_follow
(
	follow_id int(11) not null auto_increment,
	follow_user_id int(11) not null,
	followed_user_id int(11) not null,
	follow_time timestamp NOT NULL default CURRENT_TIMESTAMP,
	primary key(follow_id)
)engine=innodb default charset=utf8;

CREATE  TABLE home(
	r_id int(11) not null auto_increment,
	follow_time timestamp NOT NULL default CURRENT_TIMESTAMP,
	primary key(r_id)
)engine=innodb default charset=utf8;