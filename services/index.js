require('module-alias/register');
const http = require('http'),
      BudgetManagerAPI = require('@BudgetManagerAPI'),
      BudgetManagerServer = http.Server(BudgetManagerAPI),
      BudgetManagerPORT = process.env.PORT || 3001,
      LOCAL = '127.0.0.1';

BudgetManagerServer.listen(BudgetManagerPORT, LOCAL, () => console.log(`BudgetManagerAPI running on ${BudgetManagerPORT}`));
