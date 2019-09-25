SELECT FROM_UNIXTIME(createdon,"%Y-%m-%d") FROM `journal_item` WHERE 1


SELECT * FROM `journal_item` 
WHERE FROM_UNIXTIME(createdon,"%Y-%m-%d") > date_sub(now(), interval 1 month)


SELECT * FROM `journal_item` 
WHERE FROM_UNIXTIME(createdon,"%Y-%m-%d") > date_sub(now(), interval 1 month) AND `accountid`=3 AND `debit`>0;


SELECT entry.name,entry.totalamount,entry.state FROM `journal_item` AS item JOIN `journal_entry` AS entry ON item.name = entry.name
WHERE FROM_UNIXTIME(item.createdon,"%Y-%m-%d") > date_sub(now(), interval 1 month) AND item.`accountid`=3 AND item.`debit`>0;


SELECT entry.name,entry.totalamount,entry.state,entry.id FROM `journal_item` AS item JOIN `journal_entry` AS entry ON item.name = entry.name WHERE FROM_UNIXTIME(item.createdon,"%Y-%m-%d") > date_sub(now(), interval 1 month) AND item.`accountid`=3 AND item.`debit`>0


SELECT entry.name,entry.totalamount,entry.state,entry.id,item.debit AS user_payment FROM `journal_item` AS item JOIN `journal_entry` AS entry ON item.name = entry.name
WHERE FROM_UNIXTIME(item.createdon,"%Y-%m-%d") > date_sub(now(), interval 1 month) AND item.`accountid`=3 AND item.`debit`>0


SELECT entry.name,entry.totalamount,entry.state,entry.id,item.debit AS user_payment FROM `journal_item` AS item JOIN `journal_entry` AS entry ON item.name = entry.name
WHERE FROM_UNIXTIME(item.createdon,"%Y-%m-%d") > date_sub(now(), interval 1 month) AND FROM_UNIXTIME(item.createdon,"%Y-%m-%d") <= now() AND item.`accountid`=3 AND item.`debit`>0


SELECT entry.name,entry.totalamount,entry.state,entry.id,item.debit AS user_payment,item.journalid FROM `journal_item` AS item JOIN `journal_entry` AS entry ON item.name = entry.name
WHERE FROM_UNIXTIME(item.createdon,"%Y-%m-%d") > date_sub(now(), interval 1 month) AND item.`accountid`=3 AND item.`debit`>0


SELECT entry.name,entry.totalamount,entry.state,entry.id,item.debit AS user_payment,item.journalid,entry.userid,item.productid,item.paymentid,item.invoiceid FROM `journal_item` AS item JOIN `journal_entry` AS entry ON item.name = entry.name
WHERE FROM_UNIXTIME(item.createdon,"%Y-%m-%d") > date_sub(now(), interval 1 month) AND item.`accountid`=3 AND item.`debit`>0


UPDATE `journal_item` SET `eom_status`=0 WHERE 1