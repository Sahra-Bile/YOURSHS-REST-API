
Drop database if exists YOURSHS;

CREATE DATABASE IF NOT EXISTS YOURSHS;
USE YOURSHS;
DROP TABLE IF EXISTS garments;
DROP TABLE IF EXISTS sellers;


-- sellers TABLE

CREATE TABLE sellers(
 id INT NOT NULL AUTO_INCREMENT, 
 first_name varchar(40),
 last_name varchar(40),
 email varchar(55),
 phone varchar(20),
  created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (id) 
) ENGINE=InnoDB;


-- garments table

CREATE TABLE garments(
 id INT NOT NULL  AUTO_INCREMENT,
 sellerId INT NOT NULL,
 name VARCHAR(55),
  type VARCHAR(55),
 description VARCHAR(255),
 price INT NOT NULL ,
  sold_date DATE  DEFAULT  NULL ,
 created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (id),
FOREIGN KEY (sellerId) REFERENCES sellers(id)
) ENGINE=InnoDB;


-- sellers INSERT



INSERT INTO sellers( first_name, last_name, email, phone)

VALUES( "Sahra", "Bile", "sahra.bile13456@gmail.com" , "0723201976" ),

( "Nicklas", "Söderlund", "nicklassoderlund96@gmail.com",  "0723201943"),

( "Conny", "Segerström", "hatagais@yahoo.se",  "0723201912"),

("Remy", "Raggarsträng", "raggarremy@live.se",  "0723201936"),

( "Gordon", "Smith", "gsmith@hotmail.com",  "0723201976") ,

(  "Mia", "Bush", "miabush@blogspot.com", "0723201476") ,

( "Tove", "Lissner", "tove.lissner@medieinstitutet.se",  "0723401976");



--  garments insert

INSERT INTO garments(sellerId, name, type, description,  price  )
 VALUES(1, "Pull & Bea", "jeans", "This is a second hand item. The product is in very good condition and almost like new.", 250),
 
 (3, "Pre-loved",  "dress", "This is a second hand item. The item is in good condition with no obvious defects.", 200),
 
 (2, "Amisu", "Biker jacket", "This is a second hand item. The product is in very good condition and almost like new.",  800),
 
 (6, "Amore & dress", "Long dress",  "This is a second hand item. The item is in good condition with no obvious defects.", 250),
 
 (6, "Rosemunde ", " dress",  "This is a second hand item. The item is in good condition with no obvious defects.", 299);
 
 
 INSERT INTO garments(sellerId, name, type, description,  price , sold_date )
 
 VALUES (3, "Denim dress ", " dress",  "This is a second hand item. The item is in good condition with no obvious defects.", 2249 ,  '2023-05-31'),
 (2, "COS", " dress",  "This is a second hand item. The item is in good condition with no obvious defects.", 269,  '2023-05-30');
 





 -- 	WHERE s.id = 3 AND g.sold_date IS NOT NULL om jag vill få endast sålda plagg fram och inte alla plagg som blev inlämnade 

USE YOURSHS;
 
  -- antal inlämnade plagg 
  SELECT first_name , last_name, email, phone , 
  COUNT(s.id)  AS 'number of submitted  garments' FROM  YOURSHS.sellers  s
    JOIN garments AS g
    ON g.sellerId = s.id
	WHERE s.id = 2
    ORDER BY s.id;
    
    
    
 -- antal sålda plagg
    
     SELECT first_name , last_name, email, phone , 
  COUNT(s.id)  AS 'number of sold  garments' FROM  sellers  s
    JOIN garments AS g
    ON g.sellerId = s.id
	WHERE s.id = 2 AND g.sold_date IS NOT NULL
    ORDER BY s.id;
    
    
 
  -- totala försäljningssumman

  SELECT first_name , last_name, email, phone ,  
  COUNT(g.sold_date)  AS ' number of  sold garments',  
  SUM(g.price)  'total sales amount'FROM  YOURSHS.sellers  s
    JOIN garments AS g
    ON g.sellerId = s.id
	WHERE s.id = 2 AND g.sold_date IS NOT NULL
    ORDER BY g.sold_date;
    
    
    
     -- alla plagg som säljaren lämnat in
     
      SELECT s.id  AS 'seller_id',  g.name  'product_name' , g.type 'product_type', g.description 'product_description', g.price 'product_price', 
      g.sold_date 'product_sold_date' FROM sellers  s  
      JOIN garments g ON  s.id = g.sellerId WHERE s.id = 3;
    
    



