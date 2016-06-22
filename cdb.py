import asyncio
import aiocouchdb

loop = asyncio.get_event_loop()
test = aiocouchdb.Database('http://localhost:5984/test')
server = aiocouchdb.Server()

async def all_dbs():
    dbs = await server.all_dbs()
    test = await server.db('test')
    docs = await asyncio.ensure_future(test.all_docs())
    res = await test.all_docs()
    while True:
        rec = await res.next()
        if rec is None:
            break
        print(rec)
    print(dbs)
    print(test)
    print(docs)
    dir(docs)
    print('++++++++++++++++')


asyncio.ensure_future(all_dbs())
loop.run_forever()
