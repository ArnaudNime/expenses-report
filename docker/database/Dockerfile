FROM postgres:bullseye

ENV POSTGRES_DB=app
ENV POSTGRES_USER=dev_user
ENV POSTGRES_PASSWORD=dev_password
COPY /base.sql /docker-entrypoint-initdb.d/base.sql
