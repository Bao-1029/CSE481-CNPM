-- [Desc] Kiểm tra nguồn tin tức
-- [Function] getSourceId
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


-- [Desc] Chèn tin tức
-- [Store Procedure] InsertNews
-- [param] title, link, source, imgUri
-- [Guide] 
--   + Lấy sourceId trong bảng (news_source) bằng hàm getSourceId bên trên
--   + Chèn dữ liệu vào bảng `news` với các dl title, link, sourceId, imgUri


-- [Desc] Lấy tin tức bắt đầu từ 1 vị trí (offset) với giới hạn số hàng (limit) từ View news_detail
-- [Store Procedure] SelectNews
-- [param] offset, limit
-- [Guide]
--     @see https://stackoverflow.com/questions/3799193/mysql-data-best-way-to-implement-paging