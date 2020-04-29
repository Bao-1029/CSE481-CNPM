-- [Note] id của các bảng đều là `auto_increment`


-- [Desc] Lấy tiêu đề mới nhất từ bảng `news`
-- [Function] f_get_latest_title_news
--     @see https://stackoverflow.com/questions/2770600/mysql-select-the-last-inserted-row-easiest-way/21683753
DELIMITER $$

Create Function f_get_latest_title_news ()
    RETURNS varchar(300)
Begin
    Declare tt varchar(300);
    Set tt = (Select title From news_detail
        Where id = (Select MAX(id) From news_detail));
    Return tt;
End$$

DELIMITER ;


-- [Desc] Kiểm tra nguồn tin tức
-- [Function] f_get_source_id
-- [param] source
-- [Guide] 
--   + Kiểm tra tham số source đã tồn tại trong bảng news_source hay chưa
--     @see https://dev.mysql.com/doc/refman/5.7/en/set-variable.html
--   + Nếu có -> trả về id
--   + Nếu chưa có (kq trả về null) -> chèn vào bảng và lấy id -> trả về id
--     @see https://www.mysqltutorial.org/mysql-select-into-variable/
--     @see https://dev.mysql.com/doc/refman/8.0/en/select-into.html
--     OR
--     @see https://stackoverflow.com/a/29150191
DELIMITER $$

Create Function f_get_source_id (source tinytext)
    RETURNS tinyint(3)
Begin
    Declare id tinyint(3);

    Select n.id Into id From news_source as n
        Where n.source = source;

    If id IS NULL THEN
        Begin
            Insert into news_source (source) Value (source);
            Set id = (SELECT LAST_INSERT_ID());
        End;
    End if;

    return id;
End$$

DELIMITER ;


-- [Desc] Chèn tin tức
-- [Store Procedure] sp_insert_news
-- [param] title, link, source, imgUri
-- [Guide] 
--   + Lấy sourceId trong bảng (news_source) bằng hàm getSourceId bên trên
--   + Chèn dữ liệu vào bảng `news` với các dl title, link, sourceId, imgUri
DELIMITER $$

Create Procedure sp_insert_news (title varchar(300) CHARSET utf8mb4, link varchar(3000) CHARSET utf8mb4, source tinytext CHARSET utf8mb4, imgUri varchar(3000) CHARSET utf8mb4)
Begin
    Declare id tinyint(3);
    Set id = f_get_source_id(source);
    Insert into news (title, link, sourceId, imgUri) Value (title, link, id, imgUri);
End$$

DELIMITER ;


-- [Desc] Lấy tin tức bắt đầu từ 1 vị trí (offset) với giới hạn số hàng (limit) từ View news_detail
-- [Store Procedure] sp_select_news
-- [param] numoffset, numlimit
-- [Guide]
--     @see https://stackoverflow.com/questions/3799193/mysql-data-best-way-to-implement-paging
DELIMITER $$

Create Procedure sp_select_news (num_offset smallint, num_limit smallint)
Begin
    Select title, link, source, imgUri From news_detail
        Order by id Desc Limit num_limit Offset num_offset;
End$$

DELIMITER ;