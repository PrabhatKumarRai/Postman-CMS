<?php

class Setup{

    protected $conn;
    protected $conn2;

    public function __construct($host, $username, $password){
        $this->conn = new mysqli($host, $username, $password);

        if($this->conn->connect_error){
            die("<h3> Database Connection Failed!!! Error: " . $this->conn->connect_error . "</h3>");
        }
    }    

    //***************** Database & Tables Creation Method Section Starts ******************//
    public function CreateDatabase($dbname){
        
        $sql = "CREATE DATABASE $dbname;
        USE $dbname;

        CREATE TABLE `admintheme` (
          `id` int(11) NOT NULL,
          `sidebarcolor` varchar(30) NOT NULL,
          `sidebarbg` varchar(30) NOT NULL,
          `sidebar_position` varchar(10) NOT NULL DEFAULT 'left'
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

        INSERT INTO `admintheme` (`id`, `sidebarcolor`, `sidebarbg`, `sidebar_position`) VALUES
        (1, 'cyan', '#396c77', 'left');

        CREATE TABLE `corausal` (
          `id` int(11) NOT NULL,
          `date` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
          `image` varchar(100) NOT NULL,
          `local_path` varchar(250) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

        INSERT INTO `corausal` (`id`, `date`, `image`, `local_path`) VALUES
        (24, '2020-07-12 14:26:14', 'https://scx2.b-cdn.net/gfx/news/hires/2019/2-nature.jpg', 'https://scx2.b-cdn.net/gfx/news/hires/2019/2-nature.jpg'),
        (27, '2020-07-20 09:59:27', 'https://wallpaperaccess.com/full/284466.jpg', 'https://wallpaperaccess.com/full/284466.jpg'),
        (29, '2020-08-04 20:54:09', 'https://scx2.b-cdn.net/gfx/news/hires/2019/2-nature.jpg', 'https://scx2.b-cdn.net/gfx/news/hires/2019/2-nature.jpg');

        CREATE TABLE `enquiry` (
          `id` int(11) NOT NULL,
          `date` datetime NOT NULL DEFAULT current_timestamp(),
          `enquiry` longtext NOT NULL,
          `reply` longtext NOT NULL,
          `name` varchar(256) NOT NULL,
          `email` varchar(256) NOT NULL,
          `subject` varchar(256) NOT NULL,
          `reply_date` datetime DEFAULT NULL ON UPDATE current_timestamp()
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

        INSERT INTO `enquiry` (`id`, `date`, `enquiry`, `reply`, `name`, `email`, `subject`, `reply_date`) VALUES
        (1, '2020-08-04 21:02:55', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', '', 'Sample Name', 'sample@gmail.com', 'Sample Subject', NULL);

        CREATE TABLE `gallery` (
          `id` int(11) NOT NULL,
          `date` datetime DEFAULT current_timestamp(),
          `image` varchar(100) NOT NULL,
          `caption` text NOT NULL,
          `local_path` varchar(250) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

        INSERT INTO `gallery` (`id`, `date`, `image`, `caption`, `local_path`) VALUES
        (1, '2020-07-08 16:48:29', 'https://howardspix.com/wp-content/uploads/2016/05/12-1-500x400.jpg', 'Sample Caption', 'https://howardspix.com/wp-content/uploads/2016/05/12-1-500x400.jpg'),
        (2, '2020-08-04 20:54:47', 'https://howardspix.com/wp-content/uploads/2016/05/12-1-500x400.jpg', '', 'https://howardspix.com/wp-content/uploads/2016/05/12-1-500x400.jpg'),
        (3, '2020-08-04 20:54:54', 'https://howardspix.com/wp-content/uploads/2016/05/12-1-500x400.jpg', '', 'https://howardspix.com/wp-content/uploads/2016/05/12-1-500x400.jpg');

        CREATE TABLE `posts` (
          `post_id` int(11) NOT NULL,
          `post_author` varchar(255) NOT NULL,
          `post_date` datetime DEFAULT current_timestamp(),
          `post_title` varchar(300) NOT NULL,
          `post_content` longtext NOT NULL,
          `post_featured_image` varchar(300) NOT NULL,
          `post_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
          `local_path` varchar(250) NOT NULL,
          `comment_status` int(1) NOT NULL DEFAULT 1,
          `draft` int(1) NOT NULL DEFAULT 0
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

        INSERT INTO `posts` (`post_id`, `post_author`, `post_date`, `post_title`, `post_content`, `post_featured_image`, `post_updated`, `local_path`, `comment_status`, `draft`) VALUES
        (1, 'Prabhat Rai', '2020-06-20 00:23:58', 'Sample Post 3', '<h2>What is Lorem Ipsum?</h2>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><input alt=\"\" src=\"https://www.thinkright.me/wp-content/uploads/2019/09/Untitled-design-27.jpg\" style=\"height:298px; width:500px\" type=\"image\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Why do we use it?</h2>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n', 'https://scx2.b-cdn.net/gfx/news/hires/2019/2-nature.jpg', '2020-08-04 21:04:41', '', 1, 0),
        (2, 'Prabhat Rai', '2020-06-20 20:20:58', 'Sample Post 2', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Id magni ducimus reprehenderit quibusdam iste tempora nostrum reiciendis eum minus dolorem optio provident, adipisci aperiam porro nesciunt autem, saepe nulla laboriosam ullam veniam quod dolorum? Ipsam eius magnam eum fuga quisquam placeat nostrum veritatis, consequuntur debitis impedit ipsa provident maxime? Repellendus optio voluptate quos explicabo, sint ea qui sit dolore atque veritatis fugiat neque modi itaque mollitia placeat quod excepturi aliquid sequi repudiandae illum! Quia corporis eaque magni unde facilis sed ipsa non earum ullam tempore voluptas expedita, maiores asperiores distinctio impedit ad deserunt fugiat modi commodi accusantium itaque tenetur? Tempora, facilis! Reprehenderit dolore nobis saepe iste corrupti consectetur nisi voluptates maiores labore? Vel minus quam assumenda incidunt quidem beatae perferendis consectetur quasi? Sequi ad adipisci porro quia voluptatem commodi rerum eius temporibus ipsa, dolore dolores veniam! Adipisci vero rem repellendus minima quasi, doloribus sapiente et, magni harum officiis atque, assumenda nam. Numquam odit totam pariatur voluptas saepe porro voluptatibus sed maxime eligendi doloribus quidem ab delectus veniam atque quisquam, quae ratione similique quas obcaecati eaque illum dolorum odio. Nihil error quod earum iusto unde quibusdam quae reiciendis molestias quas cum id praesentium, exercitationem placeat repudiandae laborum dignissimos laboriosam ratione minima!</p>\r\n', '', '2020-08-04 20:56:43', '', 1, 0),
        (3, 'Prabhat Rai', '2020-06-22 14:25:23', 'Sample Post 1', '<h2>What is Lorem Ipsum?</h2>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><input alt=\"\" src=\"https://www.thinkright.me/wp-content/uploads/2019/09/Untitled-design-27.jpg\" style=\"height:298px; width:500px\" type=\"image\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Why do we use it?</h2>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n', '', '2020-08-04 20:57:00', '', 1, 0);

        CREATE TABLE `post_comment` (
          `c_id` int(11) NOT NULL,
          `c_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
          `c_name` varchar(256) NOT NULL,
          `c_comment` longtext NOT NULL,
          `c_admin` int(1) DEFAULT 0,
          `post_id` int(11) NOT NULL,
          `c_email` varchar(256) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

        CREATE TABLE `post_comment_reply` (
          `cr_id` int(11) NOT NULL,
          `c_id` int(11) NOT NULL,
          `cr_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
          `cr_name` varchar(256) NOT NULL,
          `cr_reply` longtext NOT NULL,
          `cr_admin` int(1) DEFAULT 0,
          `cr_email` varchar(256) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

        CREATE TABLE `users` (
          `u_id` int(11) NOT NULL,
          `u_uname` varchar(50) NOT NULL,
          `u_pass` varchar(255) NOT NULL,
          `u_name` varchar(100) NOT NULL,
          `u_designation` varchar(50) NOT NULL,
          `u_dob` date NOT NULL,
          `u_image` varchar(256) NOT NULL,
          `u_about` longtext NOT NULL,
          `u_facebook` varchar(50) NOT NULL,
          `u_instagram` varchar(50) NOT NULL,
          `u_email` varchar(50) NOT NULL,
          `u_mobile` int(12) NOT NULL,
          `u_twitter` varchar(50) NOT NULL,
          `local_path` varchar(250) NOT NULL,
          `last_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

        CREATE TABLE `website_setting` (
          `id` int(11) NOT NULL,
          `theme` varchar(50) NOT NULL DEFAULT 'theme-1',
          `theme_color` varchar(50) NOT NULL,
          `theme_color_name` varchar(50) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

        INSERT INTO `website_setting` (`id`, `theme`, `theme_color`, `theme_color_name`) VALUES
        (1, 'theme-3', '#a73d3d', 'red');


        ALTER TABLE `admintheme`
          ADD PRIMARY KEY (`id`);

        ALTER TABLE `corausal`
          ADD PRIMARY KEY (`id`);

        ALTER TABLE `enquiry`
          ADD PRIMARY KEY (`id`);

        ALTER TABLE `gallery`
          ADD PRIMARY KEY (`id`);

        ALTER TABLE `posts`
          ADD PRIMARY KEY (`post_id`);

        ALTER TABLE `post_comment`
          ADD PRIMARY KEY (`c_id`);

        ALTER TABLE `post_comment_reply`
          ADD PRIMARY KEY (`cr_id`);

        ALTER TABLE `users`
          ADD PRIMARY KEY (`u_id`);

        ALTER TABLE `website_setting`
          ADD PRIMARY KEY (`id`);


        ALTER TABLE `admintheme`
          MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

        ALTER TABLE `corausal`
          MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

        ALTER TABLE `enquiry`
          MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

        ALTER TABLE `gallery`
          MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

        ALTER TABLE `posts`
          MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

        ALTER TABLE `post_comment`
          MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT;

        ALTER TABLE `post_comment_reply`
          MODIFY `cr_id` int(11) NOT NULL AUTO_INCREMENT;

        ALTER TABLE `users`
          MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT;

        ALTER TABLE `website_setting`
          MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;";
        

        if($this->conn->multi_query($sql)){
            return 1;
        }
        else{
            return 0;
        }
    }
    //***************** Database & Tables Creation Method Section Ends ******************//


    //***************** User Signup Method Section Starts ******************//
    public function CreateUser($hostname, $username, $password='', $dbname, $name, $designation, $u_name, $u_pass){
      $this->conn2 = new mysqli($hostname, $username, $password, $dbname);

        if($this->conn->connect_error){
            die("<h3> Database Connection Failed!!! Error: " . $this->conn->connect_error . "</h3>");
        }

      $sql = "INSERT INTO users (u_name, u_designation, u_uname, u_pass, u_about) VALUES ('$name', '$designation', '$u_name', '$u_pass', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.');";
      
      if($this->conn2->query($sql)){
        return 1;
      }
      else{
        return 0;
      }
    }
    //***************** User Signup Method Section Ends ******************//

    //***** Select Data from Users Table Method Section Starts ******//
    public function GetUser($hostname, $username, $password='', $dbname){
      $this->conn2 = new mysqli($hostname, $username, $password, $dbname);

        if($this->conn->connect_error){
            die("<h3> Database Connection Failed!!! Error: " . $this->conn->connect_error . "</h3>");
        }

        $sql = "SELECT * FROM users;";
        
        if($result = $this->conn2->query($sql)){
            if($result->num_rows < 1){
              return '2';
            }
            else{
              return $result;
            }
        }
        else{
          return '0';
        }
    }
    //***** Select Data from Users Table Method Section Ends ******//
    
}