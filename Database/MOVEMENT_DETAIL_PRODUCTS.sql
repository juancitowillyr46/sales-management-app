SELECT M.date_issue, M.concept, MD.quantity, MD.unit_price, MD.total_price  FROM db_management_app.movement M 
INNER JOIN db_management_app.movement_detail MD ON M.id = MD.movement_id 
INNER JOIN db_management_app.product P ON P.id = MD.product_id
WHERE M.date_issue BETWEEN '2021-05-18' AND '2021-05-19' AND P.uuid = '4c657c4a-b017-11eb-84ca-00fffff3cb1e';