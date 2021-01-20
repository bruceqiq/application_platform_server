### 七牛云和TOKEN管理

1.创建时，如果选择的是禁用状态则不创建token缓存数据。

2.修改时，如果选择的是禁用状态则不更新token缓存数据，并且将之前存在的token缓存数据进行删除。

3.上架时，如果上架时如果不存在token缓存数据，则创建缓存数据。如果存在缓存token信息则不处理。
    (上应用下架后，缓存中的token被删除，此时点击上架，缓存中的token仍然是空。)
    
3.下架时，如果选择下架的情况下，应该更新下架数据中的缓存token有效时间。将其设置为下架时当前时间。