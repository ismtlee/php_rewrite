php_rewrite
===========

A simple framework showing how to handle rewriting.

A nginx configuration sample should like this,

<pre>
server {
   listen 80; 
   server_name rw.lee.com;
   root /Library/usr/workshop/zend/test/html; 
   location  / { 
     index index.php;
   }   

   location ~ ^/client/(.*)$ {
    rewrite ^/client/(.*)/(.*)/(.*)$ /main.php?service=$1&cmd=$2&args=$3 break;
    rewrite ^(.*)$ 404 break;
    proxy_pass http://127.0.0.1;
    break;
   }   

   if ($fastcgi_script_name  ~* \..*\/.*php) {
      return 404;
   }   
   location ~* \.php$ {
      fastcgi_pass  unix:/tmp/php-fpm.socket;
      fastcgi_index  index.php;
      fastcgi_param  SCRIPT_FILENAME $document_root/$fastcgi_script_name;
      include        fastcgi_params;
   }   
}
</pre>
When we call http://rw.lee.com/client/LogService/logHour/,
http://rw.lee.com/main.php?service=LogService&cmd=logHour called at last.

http://rw.lee.com/client/LogService/LogHour2/1,23,4 is the same as 
http://rw.lee.com/main.php?service=LogService2&cmd=logHour2&args=1,23,4 

All other not matched will return 404.
