import asyncio
import aiohttp
import aiocouchdb


#auth = aiocouchdb.authn.BasicAuthProvider(name='admin', password='')
loop = asyncio.get_event_loop()
test = aiocouchdb.Database('http://localhost:5984/test')
server = aiocouchdb.Server()
rest = aiocouchdb.client.Resource('http://localhost:5984/test')



async def all_dbs():
    dbs = await server.all_dbs()
    test = await server.db('test')
    res = await test.all_docs()
    while True:
        rec = await res.next()
        if rec is None:
            break
        print(rec['value']['rev'])
        print(rec)
        doc = await test.doc(rec['key'])
        #response = await doc.update({"_id":rec['key'],"www": "rest"})
        response = await rest.request('PUT', path='ffec2edc824109e77dc77d9f380017c0', data={"_id":'ffec2edc824109e77dc77d9f380017c0',"test++--": "rest++--"})
    print(dbs)
    print(test)
    print(rec)
    dir(rec)
    print('++++++++++++++++')


asyncio.ensure_future(all_dbs())
loop.run_forever()
