After cloning repo for use the LDAP add in file "/vendor/edvlerblog/yii2-adldap-module/src/Ldap.php" this code:

```
use Yii;
require Yii::getAlias('@vendor') . '/adldap/adLDAP/src/adLDAP.php';
use adLDAP; //include the adLDAP class
```

If you don't want to use the LDAP just replace "User" and "LoginForm" model files to standard.